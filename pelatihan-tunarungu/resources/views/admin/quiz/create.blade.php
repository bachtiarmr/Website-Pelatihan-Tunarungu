@extends('admin.layout')

@section('title', 'Tambah Quiz - Admin')

@section('content')
<div class="container-fluid px-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Tambah Quiz Baru</h2>
            <p class="text-muted mb-0">
                Buat kuis baru untuk mengukur pemahaman peserta pelatihan.
            </p>
        </div>

        <a href="{{ route('admin.quiz.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- NOTIFIKASI ERROR VALIDASI -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- FORM TAMBAH QUIZ -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.quiz.store') }}" method="POST">
                        @csrf

                        <!-- Judul Quiz -->
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">
                                Judul Quiz <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}" 
                                   placeholder="Contoh: Evaluasi Dasar Komunikasi" 
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">
                                Deskripsi
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="3" 
                                      placeholder="Jelaskan secara singkat tentang kuis ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Materi Pelatihan -->
                        <div class="mb-3">
                            <label for="materi_id" class="form-label fw-bold">
                                Materi Pelatihan (Opsional)
                            </label>
                            <select class="form-select @error('materi_id') is-invalid @enderror" 
                                    id="materi_id" 
                                    name="materi_id">
                                <option value="">-- Pilih Materi --</option>
                                @foreach($materi as $item)
                                    <option value="{{ $item->id }}" {{ old('materi_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Grid untuk Status & Durasi -->
                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                        Draft (Belum Tampil)
                                    </option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                        Aktif (Tampil ke Peserta)
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durasi Menit -->
                            <div class="col-md-6 mb-3">
                                <label for="durasi_menit" class="form-label fw-bold">
                                    Durasi Pengerjaan (Menit) <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('durasi_menit') is-invalid @enderror" 
                                       id="durasi_menit" 
                                       name="durasi_menit" 
                                       value="{{ old('durasi_menit', 15) }}" 
                                       min="1" 
                                       required>
                                @error('durasi_menit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- TAMBAHAN: Izinkan Kerjakan Ulang -->
                        <div class="mb-4 p-3 bg-light rounded border">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="bisa_diulang" name="bisa_diulang" value="1" 
                                       {{ old('bisa_diulang') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="bisa_diulang">
                                    Izinkan Peserta Mengulang Kuis
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1">
                                Jika diaktifkan, peserta yang sudah menyelesaikan kuis bisa mengerjakannya kembali dari awal.
                            </small>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 pt-4 mt-2 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i>
                                Simpan Quiz
                            </button>
                            <a href="{{ route('admin.quiz.index') }}" class="btn btn-light px-4 border">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection