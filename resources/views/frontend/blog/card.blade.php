<article class="card post-card reveal">
    <a href="{{ route('blog.show', $post) }}" class="card-media">
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
        @if ($post->category)<span class="badge">{{ $post->category->name }}</span>@endif
    </a>
    <div class="card-body">
        <div class="card-meta">
            <span><x-icon name="calendar" size="14" /> {{ $post->published_at?->translatedFormat('d M Y') }}</span>
            <span><x-icon name="clock" size="14" /> {{ $post->reading_time }} menit baca</span>
        </div>
        <h3 class="card-title"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
        <p class="card-text">{{ $post->summary }}</p>
    </div>
</article>
