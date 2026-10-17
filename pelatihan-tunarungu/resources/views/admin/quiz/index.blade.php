@extends('admin.layout')

@section('title', 'Kelola Quiz - Admin')

@section('content')
<div class="container-fluid px-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Kelola Quiz</h2>
            <p class="text-muted mb-0">
                Kelola kuis dan evaluasi peserta pelatihan.
            </p>
        </div>

        <a href="{{ route('admin.quiz.create') }}"
           class="btn btn-primary d-inline-flex align-items-center gap-2"
           style="position: relative; z-index: 10; cursor: pointer;">
            <i class="fa-solid fa-plus"></i>
            Tambah Quiz
        </a>
    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    <!-- NOTIFIKASI ERROR -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- DAFTAR QUIZ -->
    <div class="card">
        <div class="card-body p-0">

            @if ($quizzes->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul Quiz</th>
                                <th>Materi Pelatihan</th>
                                <th>Jumlah Soal</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($quizzes as $quiz)
                                <tr>
                                    <td>
                                        {{ $quizzes->firstItem() + $loop->index }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $quiz->judul }}
                                    </td>

                                    <td>
                                        {{ $quiz->materi?->judul ?? 'Belum ditentukan' }}
                                    </td>

                                    <td>
                                        <span class="badge text-bg-info">
                                            {{ $quiz->soal_count }} soal
                                        </span>
                                    </td>

                                    <td>
                                        @if ($quiz->status === 'aktif')
                                            <span class="badge text-bg-success">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge text-bg-secondary">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.quiz.edit', $quiz) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen-to-square me-1"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.quiz.destroy', $quiz) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-3">
                    {{ $quizzes->links() }}
                </div>

            @else

                <div class="text-center py-5 px-3">
                    <div class="mb-3">
                        <i class="fa-solid fa-clipboard-question fa-3x text-secondary"></i>
                    </div>

                    <h5 class="fw-bold">Belum Ada Quiz</h5>

                    <p class="text-muted mb-4">
                        Mulai buat kuis untuk mengukur pemahaman peserta pelatihan.
                    </p>

                    <a href="{{ route('admin.quiz.create') }}"
                       class="btn btn-primary d-inline-flex align-items-center gap-2"
                       style="position: relative; z-index: 10; cursor: pointer;">
                        <i class="fa-solid fa-plus"></i>
                        Buat Quiz Pertama
                    </a>
                </div>

            @endif

        </div>
    </div>

</div>
@endsection
