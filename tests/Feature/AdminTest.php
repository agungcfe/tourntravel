<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private function admin(): User
    {
        return User::where('role', 'admin')->first();
    }

    private function editor(): User
    {
        return User::where('role', 'editor')->first();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_user_can_login_and_logout(): void
    {
        $this->post('/login', ['email' => 'admin@tourntravel.test', 'password' => 'password'])
            ->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_wrong_password_and_inactive_user_cannot_login(): void
    {
        $this->post('/login', ['email' => 'admin@tourntravel.test', 'password' => 'salah'])->assertSessionHasErrors('email');

        $this->editor()->update(['is_active' => false]);
        $this->post('/login', ['email' => 'editor@tourntravel.test', 'password' => 'password'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_all_admin_pages_load(): void
    {
        Inquiry::create(['name' => 'A', 'email' => 'a@a.com', 'package_id' => Package::first()->id]);

        $this->actingAs($this->admin());

        $pages = [
            route('admin.dashboard'), route('admin.profile.edit'),
            route('admin.destinations.index'), route('admin.destinations.create'), route('admin.destinations.edit', Destination::first()),
            route('admin.packages.index'), route('admin.packages.create'), route('admin.packages.edit', Package::first()),
            route('admin.posts.index'), route('admin.posts.create'), route('admin.posts.edit', Post::first()),
            route('admin.categories.index'),
            route('admin.testimonials.index'), route('admin.testimonials.create'), route('admin.testimonials.edit', Testimonial::first()),
            route('admin.inquiries.index'), route('admin.inquiries.show', Inquiry::first()),
            route('admin.users.index'), route('admin.users.create'), route('admin.users.edit', $this->editor()),
            route('admin.settings.edit'),
        ];

        foreach ($pages as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_editor_cannot_access_user_management_and_settings(): void
    {
        $this->actingAs($this->editor());

        $this->get(route('admin.packages.index'))->assertOk();
        $this->get(route('admin.users.index'))->assertForbidden();
        $this->get(route('admin.settings.edit'))->assertForbidden();
    }

    public function test_admin_can_manage_users(): void
    {
        $this->actingAs($this->admin());

        $this->post(route('admin.users.store'), [
            'name' => 'Staf Baru', 'email' => 'staf@test.com', 'role' => 'editor',
            'is_active' => 1, 'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
        ])->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'staf@test.com')->firstOrFail();

        $this->put(route('admin.users.update', $user), [
            'name' => 'Staf Edit', 'email' => 'staf@test.com', 'role' => 'admin', 'is_active' => 0,
        ])->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Staf Edit', 'role' => 'admin', 'is_active' => false]);

        $this->delete(route('admin.users.destroy', $user))->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // Tidak bisa menghapus diri sendiri
        $this->delete(route('admin.users.destroy', $this->admin()))->assertSessionHas('error');
    }

    public function test_content_crud_with_image_upload(): void
    {
        Storage::fake('public');
        $this->actingAs($this->editor());

        $this->post(route('admin.destinations.store'), [
            'name' => 'Pulau Belitung', 'province' => 'Bangka Belitung', 'is_active' => 1,
            'image' => UploadedFile::fake()->image('belitung.jpg'),
        ])->assertRedirect(route('admin.destinations.index'));

        $destination = Destination::where('slug', 'pulau-belitung')->firstOrFail();
        Storage::disk('public')->assertExists($destination->image);

        $this->post(route('admin.packages.store'), [
            'destination_id' => $destination->id, 'title' => 'Belitung Island Hopping',
            'duration_days' => 3, 'duration_nights' => 2, 'price' => 2500000, 'discount_price' => 2200000,
            'max_people' => 10, 'is_active' => 1,
        ])->assertRedirect(route('admin.packages.index'));

        $this->get('/paket-tour/belitung-island-hopping')->assertOk()->assertSee('Rp 2.200.000');

        $this->post(route('admin.posts.store'), [
            'title' => 'Artikel Uji', 'body' => '<p>Isi</p>', 'status' => 'published',
        ])->assertRedirect(route('admin.posts.index'));
        $this->get('/blog/artikel-uji')->assertOk();

        $this->delete(route('admin.destinations.destroy', $destination))->assertRedirect();
        $this->assertDatabaseMissing('packages', ['title' => 'Belitung Island Hopping']);
    }

    public function test_admin_can_update_settings(): void
    {
        $this->actingAs($this->admin());

        $this->put(route('admin.settings.update'), ['site_name' => 'Trip Baru'])->assertRedirect();

        $this->get('/')->assertSee('Trip Baru');
    }
}
