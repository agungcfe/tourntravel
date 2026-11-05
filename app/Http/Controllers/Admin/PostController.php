<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private ImageUploadService $images) {}

    public function index(Request $request)
    {
        $posts = Post::with(['category', 'author'])
            ->when($request->q, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', [
            'post' => new Post(['status' => Post::STATUS_DRAFT]),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'posts');
        $data['user_id'] = $request->user()->id;
        $data['published_at'] = $this->publishDate($data);

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil disimpan.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'posts', $post->image);
        $data['published_at'] = $this->publishDate($data, $post);

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $this->images->delete($post->image);
        $post->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    /** Isi tanggal terbit otomatis saat artikel pertama kali dipublish. */
    private function publishDate(array $data, ?Post $post = null)
    {
        if (! empty($data['published_at'])) {
            return $data['published_at'];
        }

        return $data['status'] === Post::STATUS_PUBLISHED ? ($post?->published_at ?? now()) : null;
    }
}
