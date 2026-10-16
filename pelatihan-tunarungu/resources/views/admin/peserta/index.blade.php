@extends('admin.layout')

@section('title', 'Data Peserta - Web Pelatihan')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 22px;
    }

    .page-description {
        color: #687f96;
        margin-top: 7px;
        font-size: 12px;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 14px;
        border-radius: 7px;
        background: #e7f0fc;
        color: #2866a5;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    .data-card {
        background: #fff;
        padding: 20px;
        border: 1px solid #e7eef6;
        border-radius: 10px;
        box-shadow: 0 3px 12px #00000008;
    }

    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-form input {
        flex: 1;
        min-width: 0;
        padding: 11px 13px;
        border: 1px solid #d6e0ec;
        border-radius: 7px;
        font-family: inherit;
        font-size: 12px;
        outline: none;
    }

    .search-form input:focus {
        border-color: #3985d8;
    }

    .btn-search {
        padding: 10px 16px;
        border: none;
        border-radius: 7px;
        background: #327fc7;
        color: white;
        cursor: pointer;
        font-family: inherit;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .participant-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    .participant-table th,
    .participant-table td {
        padding: 13px 12px;
        text-align: left;
        border-bottom: 1px solid #edf1f6;
    }

    .participant-table th {
        background: #f3f7fc;
        color: #45627e;
        font-size: 11px;
        font-weight: 600;
    }

    .participant-table td {
        color: #536b83;
        font-size: 12px;
    }

    .participant-table tbody tr:hover {
        background: #f8fbff;
    }

    .btn-detail {
        display: inline-block;
        padding: 7px 12px;
        background: #327fc7;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-size: 11px;
    }

    .empty-message {
        text-align: center !important;
        padding: 28px !important;
        color: #8293a5 !important;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination nav p {
        font-size: 12px;
        color: #687f96;
    }

    @media (max-width: 600px) {
        .data-card {
            padding: 12px;
        }

        .page-header h1 {
            font-size: 18px;
        }
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Data Peserta</h1>
        <p class="page-description">
            Kelola akun peserta pelatihan tunarungu.
        </p>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
        Dashboard
    </a>
</div>

<div class="data-card">

    <form
        action="{{ route('admin.peserta.index') }}"
        method="GET"
        class="search-form"
    >
        <input
            type="search"
            name="cari"
            placeholder="Cari nama atau email peserta..."
            value="{{ request('cari') }}"
            aria-label="Cari peserta"
        >

        <button type="submit" class="btn-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            Cari
        </button>
    </form>

    <div class="table-wrapper">
        <table class="participant-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($peserta as $item)
                    <tr>
                        <td>{{ $peserta->firstItem() + $loop->index }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                        </td>
                        <td>
                            <a
                                href="{{ route('admin.peserta.show', $item->id) }}"
                                class="btn-detail"
                            >
                                <i class="fa-regular fa-eye"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-message">
                            <i class="fa-solid fa-users"></i>
                            <p>Belum ada peserta yang terdaftar.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $peserta->links() }}
    </div>

</div>

@endsection
