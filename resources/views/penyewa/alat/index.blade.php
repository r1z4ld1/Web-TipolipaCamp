@extends('layouts.admin.app')

@section('title', 'Daftar Alat')

@section('content')

    <div class="page-header">
    <div class="page-title-wrap">
        <h1>Daftar Alat Camping</h1>
        <p>Pilih alat camping yang tersedia untuk disewa.</p>
    </div>

    <div class="d-flex align-items-center gap-2 flex-wrap">
    <form id="penyewaAlatSearchForm" action="{{ route('penyewa.alat.index') }}" method="GET" style="margin: 0;">
    <div style="position: relative;">
        <input type="text"
               id="penyewaAlatSearchInput"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari alat camping..."
               autocomplete="off"
               style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

        @if (request('search'))
            <a href="{{ route('penyewa.alat.index') }}"
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

</div>
</div>
    @if (session('success'))
    <div class="alert-success-modern">
        <div class="left">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert-error-modern">
        <i class="bi bi-exclamation-circle-fill"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

    <div class="content-card">
        @if ($barangs->count())
            <div class="alat-grid">
                @foreach ($barangs as $barang)
                    <div class="alat-card">
                        <div class="alat-image-wrap">
                            @if ($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}"
                                     alt="{{ $barang->nama_barang }}"
                                     class="alat-image">
                            @else
                                <div class="alat-image-empty">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>

                        <div class="alat-body">
                            <div class="alat-category">
                                {{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                            </div>

                            <h3>{{ $barang->nama_barang }}</h3>

                            <p>
                                {{ $barang->deskripsi ? \Illuminate\Support\Str::limit($barang->deskripsi, 90) : 'Tidak ada deskripsi.' }}
                            </p>

                            <div class="alat-info">
                                <div>
                                    <span>Harga / Hari</span>
                                    <strong>Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</strong>
                                </div>

                                <div>
                                    <span>Stok</span>
                                    <strong>{{ $barang->stok }} unit</strong>
                                </div>
                            </div>

                            <div class="alat-footer">
                                @if ($barang->kondisi === 'baik')
                                    <span class="badge badge-green">Baik</span>
                                @elseif ($barang->kondisi === 'rusak_ringan')
                                    <span class="badge badge-gold">Rusak Ringan</span>
                                @else
                                    <span class="badge badge-pink">Rusak Berat</span>
                                @endif
                                <a href="{{ route('penyewa.sewa.create', $barang->id) }}"
                                class="btn-sewa-disabled">
                                    <i class="bi bi-cart-plus-fill"></i>
                                    Sewa
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="alat-table-footer">

            <x-custom-pagination :paginator="$barangs" />

        @else
            <div style="padding: 42px; text-align: center; color: #64748b;">
                <div style="width: 70px; height: 70px; border-radius: 22px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;">
                    <i class="bi bi-box-seam" style="font-size: 30px;"></i>
                </div>

                <h3 style="margin: 0 0 6px; color: #1f2937;">
    @if (request('search'))
        Alat tidak ditemukan.
    @else
        Belum ada alat tersedia.
    @endif
</h3>

<p style="margin: 0;">
    @if (request('search'))
        Tidak ada alat camping dengan kata kunci "{{ request('search') }}".
    @else
        Silakan cek kembali nanti.
    @endif
</p>
            </div>
        @endif
    </div>
    <script>
    const penyewaAlatSearchInput = document.getElementById('penyewaAlatSearchInput');
    const penyewaAlatSearchForm = document.getElementById('penyewaAlatSearchForm');

    if (penyewaAlatSearchInput && penyewaAlatSearchForm) {
        let penyewaAlatTypingTimer;
        let lastPenyewaAlatSearchValue = penyewaAlatSearchInput.value;

        penyewaAlatSearchInput.addEventListener('input', function () {
            clearTimeout(penyewaAlatTypingTimer);

            penyewaAlatTypingTimer = setTimeout(function () {
                const currentValue = penyewaAlatSearchInput.value.trim();

                if (currentValue === lastPenyewaAlatSearchValue.trim()) {
                    return;
                }

                if (currentValue.length === 0 || currentValue.length >= 2) {
                    penyewaAlatSearchForm.submit();
                }
            }, 1000);
        });
    }
</script>
@endsection

@push('styles')
    <style>
        .alat-table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-top: 22px;
}

.alat-table-info {
    color: #64748b;
    font-size: 14px;
    font-weight: 500;
}

.alat-pagination {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}

.alat-pagination-btn,
.alat-pagination-page {
    min-width: 34px;
    height: 34px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #0f172a;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 800;
    text-decoration: none;
    transition: all 0.2s ease;
}

.alat-pagination-btn:hover,
.alat-pagination-page:hover {
    background: #e8f1ff;
    color: #1d5fd0;
    border-color: #bfdbfe;
}

.alat-pagination-page.active {
    background: #0a2f63;
    color: #ffffff;
    border-color: #0a2f63;
}

.alat-pagination-btn.disabled {
    opacity: 0.45;
    cursor: not-allowed;
    background: #f8fafc;
}

@media (max-width: 576px) {
    .alat-table-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .alat-pagination {
        justify-content: flex-start;
        flex-wrap: wrap;
    }
}
        .alat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .alat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
        }

        .alat-image-wrap {
            height: 190px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .alat-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .alat-image-empty {
            width: 100%;
            height: 100%;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
        }

        .alat-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .alat-category {
            display: inline-flex;
            width: fit-content;
            background: #e8f1ff;
            color: #1d5fd0;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .alat-body h3 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #1f2937;
            font-weight: 900;
        }

        .alat-body p {
            margin: 0 0 16px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            min-height: 42px;
        }

        .alat-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }

        .alat-info div {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 12px;
        }

        .alat-info span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .alat-info strong {
            color: #1f2937;
            font-size: 13px;
            font-weight: 900;
        }

        .alat-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: auto;
        }

        .btn-sewa-disabled {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #092a56;
            color: #ffffff;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 900;
        }

        .btn-sewa-disabled:hover {
            background: #061f42;
            color: #ffffff;
        }

        @media (max-width: 1199.98px) {
            .alat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .alat-grid {
                grid-template-columns: 1fr;
            }

            .alat-image-wrap {
                height: 180px;
            }
        }
    </style>
@endpush
