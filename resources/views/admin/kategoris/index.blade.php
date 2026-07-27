@extends('layouts.admin.app')

@section('title', 'Kategori Alat')
@section('page-title', 'Kategori Alat')
@section('page-subtitle', 'Kelola kategori perlengkapan camping yang tersedia')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Daftar Kategori</h2>
                <p class="text-muted mb-0">
                    Kategori digunakan untuk mengelompokkan alat camping agar lebih rapi.
                </p>
            </div>

            @can('kategori.create')
                <a href="{{ route('admin.kategoris.create') }}" class="btn-navy" style="text-decoration: none;">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Kategori
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
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Nama Kategori</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Slug</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Deskripsi</th>
                        <th style="padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0;">Status</th>
                        <th style="padding: 14px; text-align: center; border-bottom: 1px solid #e2e8f0;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                {{ $kategoris->firstItem() + $loop->index }}
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon blue mb-0" style="width: 42px; height: 42px; border-radius: 14px; font-size: 18px;">
                                        @php
    $kategoriSlug = $kategori->slug ?? \Illuminate\Support\Str::slug($kategori->nama_kategori);

    $kategoriIcons = [
        'tenda' => 'bi-triangle-fill',
        'sleeping-bag' => 'bi-moon-stars-fill',
        'carrier' => 'bi-backpack-fill',
        'matras' => 'bi-layers-fill',
        'peralatan-masak' => 'bi-cup-hot-fill',
        'penerangan' => 'bi-lightbulb-fill',
        'furniture-camping' => 'bi-lamp-fill',
        'perlengkapan-outdoor' => 'bi-compass-fill',
    ];

    $iconKategori = $kategoriIcons[$kategoriSlug] ?? 'bi-tag-fill';
@endphp

<div class="category-icon">
    <i class="bi {{ $iconKategori }}"></i>
</div>
                                    </div>

                                    <div>
                                        <div class="fw-bold">{{ $kategori->nama_kategori }}</div>
                                        <div class="small text-muted">
                                            Dibuat {{ $kategori->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                <span class="badge">
                                    {{ $kategori->slug }}
                                </span>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0; min-width: 260px;">
                                <span class="text-muted small">
                                    {{ $kategori->deskripsi ?? '-' }}
                                </span>
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0;">
                                @if ($kategori->status === 'aktif')
                                    <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 8px 12px; border-radius: 999px; font-weight: 700; font-size: 13px;">
                                        Aktif
                                    </span>
                                @else
                                    <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 8px 12px; border-radius: 999px; font-weight: 700; font-size: 13px;">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td style="padding: 14px; border-bottom: 1px solid #e2e8f0; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
                                    @can('kategori.edit')
                                        <a href="{{ route('admin.kategoris.edit', $kategori->id) }}"
                                           title="Edit Kategori"
                                           class="btn-action-edit">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    @endcan

                                    @can('kategori.delete')
                                    <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}"
                                    method="POST"
                                    onsubmit="return isiAlasanHapusKategori(this)"
                                    style="margin: 0;">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="alasan_penghapusan" class="alasan-penghapusan">

                                    <button type="submit"
                                            title="Hapus Kategori"
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
                            <td colspan="6" style="padding: 30px; text-align: center; color: #64748b;">
                                <i class="bi bi-info-circle"></i>
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$kategoris" />

    </div>
    <script>
    function isiAlasanHapusKategori(form) {
        const alasan = prompt('Masukkan alasan penghapusan kategori ini:');

        if (alasan === null) {
            return false;
        }

        if (alasan.trim() === '') {
            alert('Alasan penghapusan wajib diisi.');
            return false;
        }

        form.querySelector('.alasan-penghapusan').value = alasan.trim();

        return confirm('Yakin ingin menghapus kategori ini?');
    }
</script>
@endsection