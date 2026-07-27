@extends('layouts.admin.app')

@section('title', 'Data User')
@section('page-title', 'Data User')
@section('page-subtitle', 'Kelola data user, role, dan akses pengguna sistem')

@section('content')
    <div class="card-modern p-4 admin-wide-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Daftar User</h2>
                <p class="text-muted mb-0">
                    Data pengguna yang terdaftar pada sistem penyewaan alat camping.
                </p>
            </div>

            @can('user.create')
                <a href="{{ route('admin.users.create') }}" class="btn-navy" style="text-decoration: none;">
                    <i class="bi bi-plus-circle"></i>
                    Tambah User
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 14px 16px; border-radius: 14px; margin-bottom: 18px; font-weight: 600;">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 14px 16px; border-radius: 14px; margin-bottom: 18px; font-weight: 600;">
                <i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="user-table-scroll">
            <table class="user-table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-3 user-name-wrap">
                                    <div class="profile-avatar user-avatar-small">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>

                                        @if (auth()->id() === $user->id)
                                            <div class="small text-muted">Akun sedang login</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                @forelse ($user->roles as $role)
                                    <span class="badge">{{ $role->name }}</span>
                                @empty
                                    <span class="text-muted small">Belum ada role</span>
                                @endforelse
                            </td>

                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td>
                                <div class="user-action-wrap">
                                    @can('user.edit')
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           title="Edit User"
                                           class="btn-action-edit">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    @endcan

                                    @can('user.delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus User"
                                                    class="btn-action-delete"
                                                    {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #64748b;">
                                <i class="bi bi-info-circle"></i>
                                Belum ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$users" />
    </div>
@endsection

@push('styles')
    <style>
        .admin-wide-card {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .user-table-scroll {
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            -webkit-overflow-scrolling: touch;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #ffffff;
        }

        .user-table-modern {
            width: 100% !important;
            min-width: 820px;
            border-collapse: collapse;
            table-layout: auto;
            background: #ffffff;
        }

        .user-table-modern thead tr {
            background: #f8fafc;
        }

        .user-table-modern th {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            color: #111827;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .user-table-modern td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #1f2937;
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .user-table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .user-table-modern th:nth-child(1),
        .user-table-modern td:nth-child(1) {
            width: 60px;
        }

        .user-table-modern th:nth-child(2),
        .user-table-modern td:nth-child(2) {
            min-width: 220px;
        }

        .user-table-modern th:nth-child(3),
        .user-table-modern td:nth-child(3) {
            min-width: 230px;
        }

        .user-table-modern th:nth-child(4),
        .user-table-modern td:nth-child(4) {
            min-width: 130px;
        }

        .user-table-modern th:nth-child(5),
        .user-table-modern td:nth-child(5) {
            min-width: 150px;
        }

        .user-table-modern th:nth-child(6),
        .user-table-modern td:nth-child(6) {
            width: 170px;
            text-align: center;
        }

        .user-name-wrap {
            min-width: 0;
        }

        .user-avatar-small {
            width: 38px !important;
            height: 38px !important;
            border-radius: 12px !important;
            flex-shrink: 0;
        }

        .user-action-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        @media (max-width: 991.98px) {
            .user-table-modern {
                min-width: 820px;
            }
        }

        @media (max-width: 767.98px) {
            .user-table-scroll {
                overflow-x: auto !important;
            }

            .user-table-modern {
                min-width: 760px;
            }
        }
    </style>
@endpush