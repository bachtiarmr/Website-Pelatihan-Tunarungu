@extends('admin.layout')

@section('title', 'Kategori Pelatihan - Web Pelatihan')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 22px;
    }

    .page-description {
        color: #687f96;
        margin-top: 7px;
    }

    .card {
        background: #fff;
        border: 1px solid #e7eef6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-row input {
        flex: 1;
        min-width: 200px;
        padding: 11px;
        border: 1px solid #d6e0ec;
        border-radius: 7px;
        font-family: inherit;
    }

    .btn-primary {
        background: #327fc7;
        color: white;
        border: none;
        padding: 11px 16px;
        border-radius: 7px;
        cursor: pointer;
        font-family: inherit;
        text-decoration: none;
    }

    .btn-delete {
        background: #fde8e8;
        color: #bd3030;
        border: none;
        padding: 7px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-family: inherit;
    }

    .alert-success {
        background: #e6f7ed;
        color: #247747;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 16px;
    }

    .alert-error {
        color: #bd3030;
        margin-top: 8px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 13px 12px;
        text-align: left;
        border-bottom: 1px solid #edf1f6;
    }

    th {
        background: #f3f7fc;
        color: #45627e;
    }

    td {
        color: #536b83;
    }

    .empty {
        text-align: center;
        padding: 25px;
        color: #8293a5;
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Kategori Pelatihan</h1>
        <p class="page-description">
            Tambahkan dan kelola kategori materi pelatihan.
        </p>
    </div>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <h3 style="margin-bottom: 15px;">Tambah Kategori Baru</h3>

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <input
                type="text"
                name="nama"
                placeholder="Contoh: Desain Grafis"
                value="{{ old('nama') }}"
                maxlength="100"
                required
            >

            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-plus"></i>
                Tambah Kategori
            </button>
        </div>

        @error('nama')
            <p class="alert-error">{{ $message }}</p>
        @enderror
    </form>
</div>

<div class="card">
    <h3 style="margin-bottom: 15px;">Daftar Kategori</h3>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategori as $item)
                    <tr>
                        <td>{{ $kategori->firstItem() + $loop->index }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form
                                action="{{ route('admin.kategori.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada kategori. Silakan tambahkan kategori baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $kategori->links() }}
    </div>
</div>
@endsection
