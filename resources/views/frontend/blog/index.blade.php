@extends('layouts.frontend')

@section('title', $category ? 'Blog: ' . $category->name : 'Blog Wisata')

@section('content')
@include('frontend.partials.page-header', [
    'title' => $category ? $category->name : 'Blog Wisata',
    'subtitle' => 'Tips, panduan, dan inspirasi untuk perjalanan Anda berikutnya.',
    'image' => 'https://picsum.photos/seed/blog-header/1920/600',
])

<section class="section">
    <div class="container">
        <div class="chip-group reveal">
            <a href="{{ route('blog.index') }}" @class(['chip', 'active' => ! $category])>Semua</a>
            @foreach ($categories as $c)
                <a href="{{ route('blog.category', $c) }}" @class(['chip', 'active' => $category?->is($c)])>{{ $c->name }} <small>{{ $c->posts_count }}</small></a>
            @endforeach
        </div>

        <div class="card-grid">
            @forelse ($posts as $post)
                @include('frontend.blog.card')
            @empty
                <p class="empty">Belum ada artikel.</p>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>
</section>
@endsection
