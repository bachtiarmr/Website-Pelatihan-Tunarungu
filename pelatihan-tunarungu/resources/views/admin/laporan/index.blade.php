@extends('admin.layout')

@section('title', 'Laporan Nilai Peserta')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h2>Laporan Nilai Peserta</h2>
        <p class="text-muted mb-0">
            Pantau hasil kuis dan kompetensi peserta berdasarkan periode mingguan.
        </p>
    </div>

    <!-- FILTER PERIODE -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.laporan.index') }}"
                  method="GET"
                  class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label for="awal" class="form-label">Tanggal Awal</label>
                    <input type="date"
                           id="awal"
                           name="awal"
                           class="form-control"
                           value="{{ $awal }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label for="akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date"
                           id="akhir"
                           name="akhir"
                           class="form-control"
                           value="{{ $akhir }}"
                           min="{{ $awal }}"
                           required>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-filter me-1"></i>
                        Tampilkan
                    </button>

                    <a href="{{ route('admin.laporan.index') }}"
                       class="btn btn-outline-secondary">
                        Minggu Ini
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- RINGKASAN -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Peserta Mengikuti Kuis</div>
                    <h3>{{ $totalPeserta }}</h3>
                    <small class="text-muted">Peserta unik pada periode ini</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Total Hasil Kuis</div>
                    <h3>{{ $totalHasilKuis }}</h3>
                    <small class="text-muted">Hasil kuis yang tercatat</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Rata-rata Nilai</div>
                    <h3>{{ number_format((float) $rataRataNilai, 2) }}</h3>
                    <small class="text-muted">Dari hasil kuis pada periode ini</small>
                </div>
            </div>
        </div>

    </div>

    <!-- TABEL LAPORAN -->
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="mb-1">Rincian Hasil Kuis</h5>
                    <small class="text-muted">
                        Periode {{ \Carbon\Carbon::parse($awal)->format('d-m-Y') }}
                        sampai {{ \Carbon\Carbon::parse($akhir)->format('d-m-Y') }}
                    </small>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Judul Kuis</th>
                            <th>Jawaban Benar</th>
                            <th>Jumlah Soal</th>
                            <th>Nilai</th>
                            <th>Tanggal Pengerjaan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($hasilKuis as $index => $hasil)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $hasil->peserta->name ?? 'Peserta tidak ditemukan' }}
                                </td>
                                <td>
                                    {{ $hasil->quiz->judul ?? 'Kuis tidak ditemukan' }}
                                </td>
                                <td>{{ $hasil->jumlah_benar }}</td>
                                <td>{{ $hasil->jumlah_soal }}</td>
                                <td>
                                    <span class="badge bg-success">
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
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada hasil kuis pada periode ini.
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
