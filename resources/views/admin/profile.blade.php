@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<form method="POST" action="{{ route('admin.profile.update') }}">
    @csrf @method('PUT')
    <div class="form-layout">
        <div class="panel">
            <h3 class="panel-title">Informasi Akun</h3>
            <label class="field"><span>Nama</span><input class="input" name="name" value="{{ old('name', $user->name) }}" required></label>
            <label class="field"><span>Email</span><input class="input" type="email" name="email" value="{{ old('email', $user->email) }}" required></label>
            <p class="muted">Role: <strong>{{ $user->role_label }}</strong></p>
        </div>
        <div class="panel">
            <h3 class="panel-title">Ganti Password</h3>
            <label class="field"><span>Password Saat Ini</span><input class="input" type="password" name="current_password" autocomplete="current-password"></label>
            <label class="field"><span>Password Baru</span><input class="input" type="password" name="password" autocomplete="new-password"></label>
            <label class="field"><span>Konfirmasi Password Baru</span><input class="input" type="password" name="password_confirmation" autocomplete="new-password"></label>
            <button class="btn btn-primary btn-block">Simpan Perubahan</button>
        </div>
    </div>
</form>
@endsection
