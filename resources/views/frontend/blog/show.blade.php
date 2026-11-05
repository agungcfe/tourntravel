@extends('layouts.frontend')

@section('title', $post->title)
@section('meta_description', (string) $post->summary)

@section('content')
@include('frontend.partials.page-header', ['title' => $post->title, 'image' => $post->image_url])

<section class="section">
    <div class="container layout-sidebar">
        <article class="article reveal">
            <div class="card-meta">
                @if ($post->category)<a class="chip active" href="{{ route('blog.category', $post->category) }}">{{ $post->category->name }}</a>@endif
                <span><x-icon name="user" size="14" /> {{ $post->author?->name ?? 'Admin' }}</span>
                <span><x-icon name="calendar" size="14" /> {{ $post->published_at?->translatedFormat('d F Y') }}</span>
                <span><x-icon name="clock" size="14" /> {{ $post->reading_time }} menit baca</span>
            </div>
            <img class="article-cover" src="{{ $post->image_url }}" alt="{{ $post->title }}">
            <div class="prose">{!! $post->body !!}</div>
        </article>

        <aside class="sidebar">
            <div class="sidebar-box">
                <h4>Artikel Terbaru</h4>
                @foreach ($recent as $r)
                    <a href="{{ route('blog.show', $r) }}" class="mini-post">
                        <img src="{{ $r->image_url }}" alt="{{ $r->title }}" loading="lazy">
                        <div><strong>{{ $r->title }}</strong><small>{{ $r->published_at?->translatedFormat('d M Y') }}</small></div>
                    </a>
                @endforeach
            </div>
            <div class="sidebar-box sidebar-cta">
                <h4>Butuh Bantuan Merencanakan Trip?</h4>
                <p>Konsultasi gratis dengan travel consultant kami.</p>
                <a href="{{ route('contact') }}" class="btn btn-accent btn-block">Hubungi Kami</a>
            </div>
        </aside>
    </div>
</section>
@endsection
