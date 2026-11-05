<a href="{{ route('destinations.show', $destination) }}" class="destination-card reveal">
    <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" loading="lazy">
    <div class="destination-overlay">
        <span class="destination-province"><x-icon name="map-pin" size="14" /> {{ $destination->province }}</span>
        <h3>{{ $destination->name }}</h3>
        <span class="destination-count">{{ $destination->packages_count ?? $destination->packages()->count() }} paket tersedia <x-icon name="arrow-right" size="14" /></span>
    </div>
</a>
