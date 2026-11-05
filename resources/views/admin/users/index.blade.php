@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="panel">
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search">
                <x-icon name="search" size="18" />
                <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari nama / email...">
            </div>
            <select class="input" name="role" onchange="this.form.submit()">
                <option value="">Semua role</option>
                @foreach (\App\Models\User::ROLES as $key => $label)
                    <option value="{{ $key }}" @selected(request('role') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><x-icon name="plus" size="16" /> Tambah User</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>User</th><th>Role</th><th>Login Terakhir</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <div class="media">
                                <span class="avatar">{{ $user->initials }}</span>
                                <div><strong>{{ $user->name }}</strong> @if ($user->is(auth()->user()))<span class="tag">Anda</span>@endif<br><small class="muted">{{ $user->email }}</small></div>
                            </div>
                        </td>
                        <td><span class="role role-{{ $user->role }}">{{ $user->role_label }}</span></td>
                        <td>{{ $user->last_login_at?->diffForHumans() ?? 'Belum pernah' }}</td>
                        <td>@include('admin.partials.status', ['active' => $user->is_active])</td>
                        <td class="right actions">
                            <a href="{{ route('admin.users.edit', $user) }}" class="icon-btn" title="Edit"><x-icon name="edit" size="16" /></a>
                            @unless ($user->is(auth()->user()))
                                @include('admin.partials.delete-button', ['action' => route('admin.users.destroy', $user), 'label' => $user->name])
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">User tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
@endsection
