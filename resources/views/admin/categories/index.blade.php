@extends('layouts.admin')

@section('title', 'Kategori Blog')

@section('content')
<div class="form-layout">
    <div class="panel">
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Nama Kategori</th><th>Jumlah Artikel</th><th class="right">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="inline-edit">
                                    @csrf @method('PUT')
                                    <input class="input" name="name" value="{{ $category->name }}" required>
                                    <button class="icon-btn" title="Simpan"><x-icon name="check" size="16" /></button>
                                </form>
                            </td>
                            <td>{{ $category->posts_count }}</td>
                            <td class="right actions">
                                @include('admin.partials.delete-button', ['action' => route('admin.categories.destroy', $category), 'label' => $category->name])
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <h3 class="panel-title">Tambah Kategori</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <label class="field"><span>Nama Kategori</span><input class="input" name="name" required></label>
            <button class="btn btn-primary btn-block"><x-icon name="plus" size="16" /> Tambah</button>
        </form>
    </div>
</div>
@endsection
