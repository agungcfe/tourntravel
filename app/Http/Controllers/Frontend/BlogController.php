<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(?Category $category = null)
    {
        $posts = Post::published()
            ->with(['category', 'author'])
            ->when($category, fn ($q) => $q->where('category_id', $category->id))
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::withCount(['posts' => fn ($q) => $q->published()])->orderBy('name')->get();

        return view('frontend.blog.index', compact('posts', 'categories', 'category'));
    }

    public function show(Post $post)
    {
        abort_unless($post->status === Post::STATUS_PUBLISHED, 404);

        $post->load(['category', 'author']);

        $recent = Post::published()->whereKeyNot($post->id)->latest('published_at')->take(4)->get();

        return view('frontend.blog.show', compact('post', 'recent'));
    }
}
