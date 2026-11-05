<article class="card package-card reveal">
    <a href="{{ route('packages.show', $package) }}" class="card-media">
        <img src="{{ $package->image_url }}" alt="{{ $package->title }}" loading="lazy">
        @if ($package->discount_price)
            <span class="badge badge-accent">Hemat {{ round((1 - $package->discount_price / $package->price) * 100) }}%</span>
        @endif
    </a>
    <div class="card-body">
        <div class="card-meta">
            <span><x-icon name="map-pin" size="14" /> {{ $package->destination->name }}</span>
            <span><x-icon name="clock" size="14" /> {{ $package->duration_label }}</span>
        </div>
        <h3 class="card-title"><a href="{{ route('packages.show', $package) }}">{{ $package->title }}</a></h3>
        <p class="card-text">{{ $package->short_description }}</p>
        <div class="card-footer">
            <div class="price">
                <small>Mulai dari</small>
                @if ($package->discount_price)
                    <del>{{ rupiah($package->price) }}</del>
                @endif
                <strong>{{ rupiah($package->final_price) }}</strong>
            </div>
            <span class="rating"><x-icon name="star" size="14" /> {{ number_format($package->rating, 1) }}</span>
        </div>
    </div>
</article>
