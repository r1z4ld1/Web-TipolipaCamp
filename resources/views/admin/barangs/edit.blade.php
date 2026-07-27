@extends('layouts.admin.app')

@section('title', 'Edit Alat Camping')
@section('page-title', 'Edit Alat Camping')
@section('page-subtitle', 'Perbarui data alat camping, stok, harga sewa, dan foto barang')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Form Edit Alat Camping</h2>
                <p class="text-muted mb-0">
                    Perbarui data alat camping yang tersedia untuk disewakan.
                </p>
            </div>

            <a href="{{ route('admin.barangs.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 14px 16px; border-radius: 14px; margin-bottom: 18px; font-weight: 600;">
                <div style="margin-bottom: 6px;">
                    <i class="bi bi-exclamation-circle"></i>
                    Data belum valid:
                </div>

                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-weight: 500;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-xl-8">
                    <div style="margin-bottom: 18px;">
                        <label for="nama_barang" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Nama Alat
                        </label>

                        <input type="text"
                               id="nama_barang"
                               name="nama_barang"
                               value="{{ old('nama_barang', $barang->nama_barang) }}"
                               placeholder="Contoh: Tenda Dome 4 Orang"
                               style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label for="kategori_id" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Kategori
                        </label>

                        <select id="kategori_id"
                                name="kategori_id"
                                style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label for="deskripsi" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Deskripsi
                        </label>

                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  rows="4"
                                  placeholder="Masukkan deskripsi alat camping"
                                  style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; resize: vertical;">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 18px; margin-bottom: 18px;">
                        <label for="foto" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Foto Alat
                        </label>

                        <div style="width: 100%; height: 220px; border-radius: 18px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 14px; border: 1px dashed #94a3b8;">
                            <img id="previewFoto"
                                 src="{{ $barang->foto ? asset('storage/' . $barang->foto) : '' }}"
                                 alt="Preview Foto"
                                 style="{{ $barang->foto ? 'display: block;' : 'display: none;' }} width: 100%; height: 100%; object-fit: cover;">

                            <div id="placeholderFoto"
                                 style="{{ $barang->foto ? 'display: none;' : 'display: block;' }} text-align: center; color: #64748b;">
                                <i class="bi bi-image" style="font-size: 38px;"></i>
                                <div style="font-weight: 700; margin-top: 8px;">Preview Foto</div>
                                <div class="small">JPG, PNG, WEBP maksimal 2MB</div>
                            </div>
                        </div>

                        <input type="file"
                               id="foto"
                               name="foto"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               onchange="previewImage(event)"
                               style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 14px; background: white;">

                        @if ($barang->foto)
                            <p class="text-muted small" style="margin: 10px 0 0; line-height: 1.5;">
                                Foto lama akan tetap digunakan jika kamu tidak memilih foto baru.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="harga_sewa" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Harga Sewa / Hari
                        </label>

                        <input type="number"
                               id="harga_sewa"
                               name="harga_sewa"
                               value="{{ old('harga_sewa', $barang->harga_sewa) }}"
                               min="0"
                               placeholder="Contoh: 50000"
                               style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="stok" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Stok
                        </label>

                        <input type="number"
                               id="stok"
                               name="stok"
                               value="{{ old('stok', $barang->stok) }}"
                               min="0"
                               placeholder="Contoh: 5"
                               style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 24px;">
                        <label for="kondisi" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Kondisi
                        </label>

                        <select id="kondisi"
                                name="kondisi"
                                style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                            <option value="baik" {{ old('kondisi', $barang->kondisi) === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi', $barang->kondisi) === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak_berat" {{ old('kondisi', $barang->kondisi) === 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 24px;">
                        <label for="status" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Status
                        </label>

                        <select id="status"
                                name="status"
                                style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                            <option value="tersedia" {{ old('status', $barang->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak_tersedia" {{ old('status', $barang->status) === 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 16px; padding: 16px; margin-bottom: 24px;">
                <div class="fw-bold mb-1" style="color: #1e40af;">
                    <i class="bi bi-info-circle"></i>
                    Informasi
                </div>
                <p class="text-muted small mb-0">
                    Jika nama alat diubah, slug akan ikut diperbarui otomatis. Jika foto baru diupload, foto lama akan dihapus dari storage.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-navy">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.barangs.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('previewFoto');
            const placeholder = document.getElementById('placeholderFoto');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection