@extends('admin.layout')

@section('title', 'Kelola Materi - Web Pelatihan')

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

    .btn-primary {
        display: inline-block;
        background: #327fc7;
        color: white;
        padding: 11px 15px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: 600;
    }

    .card {
        background: white;
        border: 1px solid #e7eef6;
        border-radius: 10px;
        padding: 20px;
    }

    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-form input {
        flex: 1;
        min-width: 0;
        padding: 11px;
        border: 1px solid #d6e0ec;
        border-radius: 7px;
        font-family: inherit;
    }

    .search-form button {
        padding: 10px 16px;
        background: #327fc7;
        color: white;
        border: none;
        border-radius: 7px;
        cursor: pointer;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
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

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #e7f0fc;
        color: #2866a5;
        font-size: 11px;
    }

    .badge.draft {
        background: #fff2d8;
        color: #936313;
    }

    .btn-edit, .btn-delete {
        padding: 7px 10px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 11px;
    }

    .btn-edit {
        background: #e7f0fc;
        color: #2866a5;
    }

    .btn-delete {
        background: #fde8e8;
        color: #bd3030;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #8293a5;
    }

    .alert-success {
        background: #e6f7ed;
        color: #247747;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 16px;
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Materi</h1>
        <p class="page-description">
            Tambah dan kelola materi pelatihan bagi peserta tunarungu.
        </p>
    </div>

    <a href="{{ route('admin.materi.create') }}" class="btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Materi
    </a>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <form action="{{ route('admin.materi.index') }}"
          method="GET" class="search-form">
        <input type="search"
               name="cari"
               placeholder="Cari judul atau kategori materi..."
               value="{{ request('cari') }}">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Materi</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($materi as $item)
                    <tr>
                        <td>{{ $materi->firstItem() + $loop->index }}</td>

                        <td>{{ $item->judul }}</td>

                        <td>{{ $item->kategori }}</td>

                        <td>
                            @switch($item->jenis)
                                @case('teks_foto')
                                    <span class="badge">Teks / Foto</span>
                                    @break
                                @case('youtube')
                                    <span class="badge">YouTube</span>
                                    @break
                                @case('upload_video')
                                    <span class="badge">Upload Video</span>
                                    @break
                            @endswitch
                        </td>

                        <td>
                            <span class="badge {{ $item->status === 'draft' ? 'draft' : '' }}">
                                {{ $item->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.materi.edit', $item->id) }}"
                               class="btn-edit">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>

                            <form action="{{ route('admin.materi.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            <i class="fa-solid fa-book-open"></i>
                            <p>Belum ada materi yang ditambahkan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px">
        {{ $materi->links() }}
    </div>
</div>
@endsection
