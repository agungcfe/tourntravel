{{-- Tombol hapus dengan modal konfirmasi. Parameter: $action (url), $label (nama data) --}}
<form method="POST" action="{{ $action }}" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="icon-btn danger" data-confirm="Hapus &quot;{{ $label }}&quot;? Tindakan ini tidak dapat dibatalkan." title="Hapus">
        <x-icon name="trash" size="16" />
    </button>
</form>
