@extends('admin.layout')

@section('title', 'Kelola Soal - Admin')

@section('content')
<div class="container-fluid px-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Kelola Soal Quiz</h2>
            <p class="text-muted mb-0">
                Daftar soal untuk kuis: <strong>{{ $quiz->judul }}</strong>
            </p>
        </div>

        <a href="{{ route('admin.quiz.soal.create', $quiz->id) }}"
           class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Tambah Soal Baru
        </a>
    </div>

    <!-- NOTIFIKASI -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- DAFTAR SOAL -->
    <div class="card">
        <div class="card-body p-0">
            
            @if ($soals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="50%">Pertanyaan</th>
                                <th width="15%">Kunci</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soals as $index => $soal)
                                <tr>
                                    <td>{{ $soals->firstItem() + $index }}</td>
                                    <td>{{ Str::limit($soal->pertanyaan, 80) }}</td>
                                    <td>
                                        <span class="badge text-bg-success">{{ $soal->jawaban_benar }}</span>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $soals->links() }}
                </div>
            @else
                <div class="text-center py-5 px-3">
                    <div class="mb-3"><i class="fa-solid fa-file-circle-question fa-3x text-secondary"></i></div>
                    <h5 class="fw-bold">Belum Ada Soal</h5>
                    <p class="text-muted mb-4">Silakan tambahkan soal untuk kuis ini.</p>
                </div>
            @endif

        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.quiz.index') }}" class="btn btn-light border">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Quiz
        </a>
    </div>

</div>
@endsection