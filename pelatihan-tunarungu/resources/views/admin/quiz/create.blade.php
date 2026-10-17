@extends('admin.layout')

@section('title', 'Tambah Quiz - Admin')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h2 class="fw-bold mb-2">Tambah Quiz</h2>
        <p class="text-muted">Buat kuis evaluasi untuk peserta pelatihan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-4">

            <form action="{{ route('admin.quiz.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Quiz</label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Quiz Dasar Komputer"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        placeholder="Jelaskan tujuan kuis"
                    >{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="materi_id" class="form-label">Materi Pelatihan</label>
                    <select name="materi_id" id="materi_id" class="form-select">
                        <option value="">-- Pilih Materi --</option>

                        @foreach ($materi as $item)
                            <option
                                value="{{ $item->id }}"
                                @selected(old('materi_id') == $item->id)
                            >
                                {{ $item->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status Quiz</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="draft" @selected(old('status', 'draft') == 'draft')>
                            Draft
                        </option>
                        <option value="aktif" @selected(old('status') == 'aktif')>
                            Aktif
                        </option>
                    </select>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-1"></i>
                        Simpan Quiz
                    </button>

                    <a href="{{ route('admin.quiz.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
