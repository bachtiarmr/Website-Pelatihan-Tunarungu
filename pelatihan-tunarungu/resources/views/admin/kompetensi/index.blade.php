```php
@extends('admin.layout')

@section('title', 'Kompetensi Peserta')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h2>Kompetensi Peserta</h2>
        <p class="text-muted mb-0">
            Peringkat peserta berdasarkan rata-rata nilai kuis yang telah dikerjakan.
        </p>
    </div>

    <!-- RINGKASAN -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Total Peserta Berperingkat</div>
                    <h3 class="mb-0">
                        {{ $peringkatAtas->count() + $peringkatLainnya->count() }}
                    </h3>
                    <small class="text-muted">Peserta yang sudah mengerjakan kuis</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Rata-rata Tertinggi</div>
                    <h3 class="mb-0">
                        {{ $peringkatAtas->isNotEmpty()
                            ? number_format((float) $peringkatAtas->first()->hasil_quizzes_avg_nilai, 2)
                            : '-' }}
                    </h3>
                    <small class="text-muted">Nilai rata-rata kuis</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">10 Peserta Teratas</div>
                    <h3 class="mb-0">{{ $peringkatAtas->count() }}</h3>
                    <small class="text-muted">Berdasarkan rata-rata nilai</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 10 PESERTA TERATAS -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">
                <i class="fa-solid fa-trophy text-warning me-2"></i>
                10 Peserta dengan Rata-rata Nilai Tertinggi
            </h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>Jumlah Kuis</th>
                            <th>Rata-rata Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peringkatAtas as $index => $peserta)
                            <tr>
                                <td>
                                    @if($index === 0)
                                        <span class="badge bg-warning text-dark">1</span>
                                    @elseif($index === 1)
                                        <span class="badge bg-secondary">2</span>
                                    @elseif($index === 2)
                                        <span class="badge bg-info text-dark">3</span>
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </td>
                                <td>{{ $peserta->name }}</td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->hasil_quizzes_count }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ number_format((float) $peserta->hasil_quizzes_avg_nilai, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada peserta yang menyelesaikan kuis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PESERTA LAINNYA -->
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">
                <i class="fa-solid fa-users me-2"></i>
                Peserta Lainnya
            </h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>Jumlah Kuis</th>
                            <th>Rata-rata Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peringkatLainnya as $index => $peserta)
                            <tr>
                                <td>{{ $peringkatAtas->count() + $index + 1 }}</td>
                                <td>{{ $peserta->name }}</td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->hasil_quizzes_count }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ number_format((float) $peserta->hasil_quizzes_avg_nilai, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Tidak ada peserta lainnya.
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
```