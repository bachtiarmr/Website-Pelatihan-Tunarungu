@extends('admin.layout')

@section('title', 'Edit Quiz - Admin')

@section('content')
<div class="container-fluid px-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Edit Quiz</h2>
            <p class="text-muted mb-0">
                Perbarui data kuis atau kelola daftar soalnya.
            </p>
        </div>

        <a href="{{ route('admin.quiz.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- NOTIFIKASI ERROR -->
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

    <div class="row">
        <!-- KIRI: FORM EDIT QUIZ -->
        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0">Informasi Quiz</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Judul Quiz -->
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold small">Judul Quiz <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul', $quiz->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold small">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $quiz->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Materi Pelatihan -->
                        <div class="mb-3">
                            <label for="materi_id" class="form-label fw-bold small">Materi Pelatihan (Opsional)</label>
                            <select class="form-select @error('materi_id') is-invalid @enderror" 
                                    id="materi_id" name="materi_id">
                                <option value="">-- Pilih Materi --</option>
                                @foreach($materi as $item)
                                    <option value="{{ $item->id }}" {{ old('materi_id', $quiz->materi_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status & Durasi -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold small">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="draft" {{ old('status', $quiz->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="aktif" {{ old('status', $quiz->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="durasi_menit" class="form-label fw-bold small">Durasi (Menit) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('durasi_menit') is-invalid @enderror" 
                                       id="durasi_menit" name="durasi_menit" value="{{ old('durasi_menit', $quiz->durasi_menit ?? 15) }}" min="1" required>
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
                                       {{ old('bisa_diulang', $quiz->bisa_diulang ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="bisa_diulang">
                                    Izinkan Peserta Mengulang Kuis
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1">
                                Jika diaktifkan, peserta yang sudah menyelesaikan kuis bisa mengerjakannya kembali dari awal.
                            </small>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 pt-3 mt-2 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Quiz
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- KANAN: DAFTAR SOAL -->
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Daftar Soal</h5>
                    <span class="badge text-bg-info">{{ $quiz->soal->count() }} Soal</span>
                </div>
                <div class="card-body p-0">
                    
                    @if($quiz->soal->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($quiz->soal as $index => $soal)
                                <li class="list-group-item py-3">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <small class="text-muted fw-bold mb-1">Soal {{ $index + 1 }}</small>
                                        <span class="badge text-bg-success">Kunci: {{ $soal->jawaban_benar }}</span>
                                    </div>
                                    <p class="mb-1 small">{{ Str::limit($soal->pertanyaan, 80) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-file-circle-question fa-2x mb-2"></i>
                            <p class="small mb-0">Belum ada soal.</p>
                        </div>
                    @endif
                    
                </div>
                <div class="card-footer bg-white p-3 text-center">
                    <a href="{{ route('admin.quiz.soal.create', $quiz->id) }}" class="btn btn-outline-primary w-100">
                        <i class="fa-solid fa-plus me-1"></i> Kelola / Tambah Soal
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection