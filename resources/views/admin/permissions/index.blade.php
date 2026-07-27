@extends('layouts.admin.app')

@section('title', 'Data Permission')
@section('page-title', 'Data Permission')
@section('page-subtitle', 'Kelola permission sebagai hak akses detail setiap role')

@section('content')
    <div class="card-modern p-4">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 18px;">
    <div>
        <h2 class="fw-bold mb-1">Daftar Permission</h2>
        <p class="text-muted mb-0">
            Permission digunakan untuk membatasi menu dan aksi yang bisa dilakukan oleh role.
        </p>
    </div>

    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-left: auto;">
        <form id="permissionSearchForm" action="{{ route('admin.permissions.index') }}" method="GET" style="margin: 0;">
            <div style="position: relative;">
                <input type="text"
                       id="permissionSearchInput"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari permission..."
                       autocomplete="off"
                       style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

                @if (request('search'))
                    <a href="{{ route('admin.permissions.index') }}"
                       title="Reset pencarian"
                       style="position: absolute; right: 43px; top: 50%; transform: translateY(-50%); border: none; background: #ffffff; color: #0a2f63; width: 28px; height: 28px; border-radius: 9px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 16px;">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif

                <button type="submit"
                        style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); border: none; background: #0a2f63; color: #ffffff; width: 30px; height: 30px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        
        @can('permission.create')
            <a href="{{ route('admin.permissions.create') }}" class="btn-navy" style="text-decoration: none;">
                <i class="bi bi-plus-circle"></i>
                Tambah Permission
            </a>
        @endcan
    </div>
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
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Nama Permission</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Group</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Guard</th>
                        <th style="padding: 14px; text-align: center; border-bottom: 1px solid #e2e8f0;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($permissions as $permission)
                        @php
                            $parts = explode('.', $permission->name);
                            $group = $parts[0] ?? '-';
                        @endphp

                        <tr>
                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                {{ $permissions->firstItem() + $loop->index }}
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon gold mb-0" style="width: 42px; height: 42px; border-radius: 14px; font-size: 18px;">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold">{{ $permission->name }}</div>
                                        <div class="small text-muted">Hak akses sistem</div>
                                    </div>
                                </div>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <span class="badge" style="text-transform: capitalize;">
                                    {{ $group }}
                                </span>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                {{ $permission->guard_name }}
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
                                    @can('permission.edit')
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                           title="Edit Permission"
                                           class="btn-action-edit">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    @endcan

                                    @can('permission.delete')
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus permission ini?')"
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus Permission"
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
    @if (request('search'))
        Permission dengan kata kunci "{{ request('search') }}" tidak ditemukan.
    @else
        Belum ada data permission.
    @endif
</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$permissions" />
    </div>
    <script>
    const permissionSearchInput = document.getElementById('permissionSearchInput');
    const permissionSearchForm = document.getElementById('permissionSearchForm');

    if (permissionSearchInput && permissionSearchForm) {
        let permissionTypingTimer;
        let lastPermissionSearchValue = permissionSearchInput.value;

        permissionSearchInput.addEventListener('input', function () {
            clearTimeout(permissionTypingTimer);

            permissionTypingTimer = setTimeout(function () {
                const currentValue = permissionSearchInput.value.trim();

                if (currentValue === lastPermissionSearchValue.trim()) {
                    return;
                }

                if (currentValue.length === 0 || currentValue.length >= 2) {
                    permissionSearchForm.submit();
                }
            }, 1000);
        });
    }
</script>
@endsection
