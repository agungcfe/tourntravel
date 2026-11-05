@extends('layouts.admin')

@section('title', $user->exists ? 'Edit User' : 'Tambah User')

@section('content')
@php $isSelf = $user->exists && $user->is(auth()->user()); @endphp
<form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}">
    @csrf
    @if ($user->exists) @method('PUT') @endif

    <div class="form-layout">
        <div class="panel">
            <h3 class="panel-title">Data Akun</h3>
            <div class="grid-2">
                <label class="field"><span>Nama Lengkap *</span><input class="input" name="name" value="{{ old('name', $user->name) }}" required></label>
                <label class="field"><span>Email *</span><input class="input" type="email" name="email" value="{{ old('email', $user->email) }}" required></label>
            </div>
            <div class="grid-2">
                <label class="field"><span>Password {{ $user->exists ? '(kosongkan jika tidak diubah)' : '*' }}</span>
                    <input class="input" type="password" name="password" autocomplete="new-password" @required(! $user->exists)>
                </label>
                <label class="field"><span>Konfirmasi Password</span>
                    <input class="input" type="password" name="password_confirmation" autocomplete="new-password">
                </label>
            </div>
        </div>

        <div class="panel">
            <h3 class="panel-title">Hak Akses</h3>
            <div class="field">
                <span>Role *</span>
                @foreach (\App\Models\User::ROLES as $key => $label)
                    <label class="radio-card">
                        <input type="radio" name="role" value="{{ $key }}" @checked(old('role', $user->role) === $key) @disabled($isSelf)>
                        <div>
                            <strong>{{ $label }}</strong>
                            <small>{{ $key === 'admin' ? 'Akses penuh termasuk user & pengaturan.' : 'Kelola konten: destinasi, paket, blog, testimoni, booking.' }}</small>
                        </div>
                    </label>
                @endforeach
                @if ($isSelf)<input type="hidden" name="role" value="{{ $user->role }}"><small class="muted">Anda tidak dapat mengubah role akun sendiri.</small>@endif
            </div>
            @unless ($isSelf)
                @include('admin.partials.toggle', ['name' => 'is_active', 'checked' => old('is_active', $user->is_active), 'label' => 'Akun aktif (bisa login)'])
            @else
                <input type="hidden" name="is_active" value="1">
            @endunless
            <div class="form-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
