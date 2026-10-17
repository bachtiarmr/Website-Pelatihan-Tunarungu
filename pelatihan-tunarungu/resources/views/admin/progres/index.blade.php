@extends('admin.layout')

@section('title', 'Progres Pelatihan')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h2 class="mb-2">Progres Pelatihan</h2>
        <p class="text-muted mb-0">
            Pantau perkembangan materi dan hasil kuis peserta pelatihan.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- DAFTAR PESERTA -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Progres Peserta</h5>

            <form action="{{ route('admin.progres.index') }}"
                  method="GET"
                  class="row g-2 mb-3">

                <div class="col-md-6">
                    <input type="text"
                           name="cari"
                           class="form-control"
                           placeholder="Cari nama atau email peserta..."
                           value="{{ request('cari') }}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i> Cari
                    </button>

                    <a href="{{ route('admin.progres.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>Materi Selesai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peserta as $index => $user)
                            <tr>
                                <td>{{ $peserta->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $user->materi_selesai }} materi
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada peserta yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $peserta->links() }}
            </div>
        </div>
    </div>

    <!-- RIWAYAT MATERI SELESAI -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Riwayat Materi Selesai</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Materi</th>
                            <th>Status</th>
                            <th>Waktu Selesai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($progresMateri as $index => $progres)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $progres->peserta->name ?? '-' }}</td>
                                <td>{{ $progres->materi->judul ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($progres->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $progres->selesai_pada
                                        ? $progres->selesai_pada->format('d-m-Y H:i')
                                        : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada materi yang diselesaikan peserta.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- HASIL KUIS -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Hasil Kuis Peserta</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Judul Kuis</th>
                            <th>Jawaban Benar</th>
                            <th>Jumlah Soal</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($hasilQuiz as $index => $hasil)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $hasil->peserta->name ?? '-' }}</td>
                                <td>{{ $hasil->quiz->judul ?? '-' }}</td>
                                <td>{{ $hasil->jumlah_benar }}</td>
                                <td>{{ $hasil->jumlah_soal }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ number_format((float) $hasil->nilai, 2) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $hasil->created_at
                                        ? $hasil->created_at->format('d-m-Y H:i')
                                        : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada hasil kuis peserta.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
