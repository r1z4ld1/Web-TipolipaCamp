@extends('layouts.admin.app')

@section('title', 'Data Role')
@section('page-title', 'Data Role')
@section('page-subtitle', 'Kelola role dan jumlah permission pada setiap role')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Daftar Role</h2>
                <p class="text-muted mb-0">
                    Role digunakan untuk mengatur hak akses user pada sistem.
                </p>
            </div>

            @can('role.create')
                <a href="{{ route('admin.roles.create') }}" class="btn-navy" style="text-decoration: none;">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Role
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

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f1f5f9;">
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">No</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Nama Role</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Jumlah Permission</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Status</th>
                        <th style="padding: 14px; text-align: center; border-bottom: 1px solid #e2e8f0;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                {{ $roles->firstItem() + $loop->index }}
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon blue mb-0" style="width: 42px; height: 42px; border-radius: 14px; font-size: 18px;">
                                        <i class="bi bi-person-badge"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold">{{ $role->name }}</div>
                                        <div class="small text-muted">Guard: {{ $role->guard_name }}</div>
                                    </div>
                                </div>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <span class="badge">
                                    {{ $role->permissions_count }} Permission
                                </span>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 8px 12px; border-radius: 999px; font-weight: 700; font-size: 13px;">
                                    Aktif
                                </span>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
                                    @can('role.edit')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                           title="Edit Role"
                                           class="btn-action-edit">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    @endcan

                                    @can('role.delete')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus role ini?')"
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus Role"
                                                    class="btn-action-delete">
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
                            <td colspan="5" style="padding: 30px; text-align: center; color: #64748b;">
                                <i class="bi bi-info-circle"></i>
                                Belum ada data role.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$roles" />
    </div>
@endsection