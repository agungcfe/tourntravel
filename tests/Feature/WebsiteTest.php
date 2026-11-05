<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_pages_load(): void
    {
        foreach (['/', '/destinasi', '/paket-tour', '/blog', '/tentang-kami', '/kontak', '/login'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_detail_pages_load(): void
    {
        $this->get(route('destinations.show', Destination::first()))->assertOk()->assertSee(Destination::first()->name);
        $this->get(route('packages.show', Package::first()))->assertOk()->assertSee('Booking Sekarang');
        $this->get(route('blog.show', Post::first()))->assertOk();
    }

    public function test_package_filter_works(): void
    {
        $this->get('/paket-tour?q=Komodo&sort=price_asc')->assertOk()->assertSee('Sailing Komodo');
    }

    public function test_draft_post_is_hidden(): void
    {
        $post = Post::first();
        $post->update(['status' => Post::STATUS_DRAFT]);

        $this->get(route('blog.show', $post))->assertNotFound();
    }

    public function test_visitor_can_send_booking(): void
    {
        $package = Package::first();

        $this->post(route('inquiries.store'), [
            'package_id' => $package->id,
            'name' => 'Tamu',
            'email' => 'tamu@example.com',
            'participants' => 2,
        ])->assertRedirect()->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', ['email' => 'tamu@example.com', 'status' => 'new']);
    }
}
