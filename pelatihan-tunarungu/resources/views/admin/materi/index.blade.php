
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
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-form input:focus {
        border-color: #327fc7;
        box-shadow: 0 0 0 3px rgba(50, 127, 199, 0.12);
    }

    .search-form button {
        padding: 10px 16px;
        background: #327fc7;
        color: white;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        white-space: nowrap;
    }

    .search-form button:hover,
    .btn-primary:hover {
        background: #2469aa;
    }

    .search-status {
        display: none;
        margin: -8px 0 14px;
        color: #687f96;
        font-size: 13px;
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
        display: inline-block;
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

    .empty i {
        font-size: 22px;
        margin-bottom: 8px;
    }

    .empty p {
        margin: 8px 0;
    }

    .alert-success {
        background: #e6f7ed;
        color: #247747;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 16px;
    }

    .pagination-wrapper {
        margin-top: 20px;
    }

    @media (max-width: 600px) {
        .search-form {
            flex-wrap: wrap;
        }

        .search-form input {
            width: 100%;
            flex-basis: 100%;
        }

        .search-form button {
            width: 100%;
        }

        .card {
            padding: 12px;
        }
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

    {{-- PENCARIAN MATERI --}}
    <form action="{{ route('admin.materi.index') }}"
          method="GET"
          class="search-form"
          id="formPencarianMateri">

        <input type="search"
               name="cari"
               id="inputCariMateri"
               placeholder="Cari judul atau kategori materi..."
               value="{{ request('cari') }}"
               autocomplete="off"
               aria-label="Cari judul atau kategori materi">

        <button type="submit" id="tombolCariMateri">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
    </form>

    <div id="statusPencarianMateri" class="search-status" role="status">
        Mencari materi...
    </div>

    {{-- TABEL MATERI --}}
    <div class="table-wrapper" id="hasilPencarianMateri">
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

                                @default
                                    <span class="badge">
                                        {{ $item->jenis }}
                                    </span>
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

    {{-- PAGINATION --}}
    <div class="pagination-wrapper" id="paginationMateri">
        {{ $materi->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('inputCariMateri');
    const form = document.getElementById('formPencarianMateri');
    const hasil = document.getElementById('hasilPencarianMateri');
    const pagination = document.getElementById('paginationMateri');
    const status = document.getElementById('statusPencarianMateri');
    const tombol = document.getElementById('tombolCariMateri');

    if (!input || !form || !hasil || !pagination || !status) {
        return;
    }

    let timer = null;
    let controller = null;
    let nomorPermintaan = 0;

    async function cariMateri(url = null) {
        clearTimeout(timer);

        timer = setTimeout(async function () {
            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            const controllerAktif = controller;
            const permintaanIni = ++nomorPermintaan;
            const kataKunci = input.value.trim();

            const alamat = new URL(
                url || form.action,
                window.location.origin
            );

            if (kataKunci) {
                alamat.searchParams.set('cari', kataKunci);
            } else {
                alamat.searchParams.delete('cari');
            }

            alamat.searchParams.delete('page');

            status.style.display = 'block';
            status.textContent = 'Mencari materi...';

            if (tombol) {
                tombol.disabled = true;
                tombol.style.opacity = '0.7';
            }

            try {
                const response = await fetch(alamat.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    },
                    signal: controllerAktif.signal
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data materi.');
                }

                const html = await response.text();

                // Abaikan hasil permintaan lama.
                if (permintaanIni !== nomorPermintaan) {
                    return;
                }

                const dokumen = new DOMParser().parseFromString(
                    html,
                    'text/html'
                );

                const hasilBaru = dokumen.getElementById(
                    'hasilPencarianMateri'
                );

                const paginationBaru = dokumen.getElementById(
                    'paginationMateri'
                );

                if (!hasilBaru || !paginationBaru) {
                    throw new Error(
                        'Bagian hasil pencarian tidak ditemukan.'
                    );
                }

                hasil.innerHTML = hasilBaru.innerHTML;
                pagination.innerHTML = paginationBaru.innerHTML;

                const urlBaru = new URL(alamat.toString());
                window.history.replaceState(
                    {},
                    '',
                    urlBaru.pathname + urlBaru.search
                );

                status.style.display = 'none';

            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Pencarian materi:', error);
                status.textContent =
                    'Pencarian gagal. Periksa koneksi atau coba lagi.';
            } finally {
                if (permintaanIni === nomorPermintaan) {
                    if (tombol) {
                        tombol.disabled = false;
                        tombol.style.opacity = '1';
                    }
                }
            }
        }, 300);
    }

    // Pencarian otomatis saat mengetik.
    input.addEventListener('input', function () {
        cariMateri();
    });

    // Tombol Cari tetap bisa digunakan.
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        cariMateri();
    });

    // Pagination tanpa reload halaman.
    pagination.addEventListener('click', function (event) {
        const link = event.target.closest('a');

        if (!link || !link.href) {
            return;
        }

        event.preventDefault();
        clearTimeout(timer);

        const alamat = new URL(link.href);

        if (input.value.trim()) {
            alamat.searchParams.set('cari', input.value.trim());
        } else {
            alamat.searchParams.delete('cari');
        }

        // Pagination menggunakan URL halaman yang dipilih.
        cariMateriHalaman(alamat.toString());
    });

    async function cariMateriHalaman(url) {
        clearTimeout(timer);

        if (controller) {
            controller.abort();
        }

        controller = new AbortController();

        const controllerAktif = controller;
        const permintaanIni = ++nomorPermintaan;

        status.style.display = 'block';
        status.textContent = 'Memuat halaman...';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: controllerAktif.signal
            });

            if (!response.ok) {
                throw new Error('Gagal memuat halaman materi.');
            }

            const html = await response.text();

            if (permintaanIni !== nomorPermintaan) {
                return;
            }

            const dokumen = new DOMParser().parseFromString(
                html,
                'text/html'
            );

            const hasilBaru = dokumen.getElementById(
                'hasilPencarianMateri'
            );

            const paginationBaru = dokumen.getElementById(
                'paginationMateri'
            );

            if (!hasilBaru || !paginationBaru) {
                throw new Error('Data halaman tidak ditemukan.');
            }

            hasil.innerHTML = hasilBaru.innerHTML;
            pagination.innerHTML = paginationBaru.innerHTML;

            const urlBaru = new URL(url);
            window.history.replaceState(
                {},
                '',
                urlBaru.pathname + urlBaru.search
            );

            status.style.display = 'none';

        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            console.error(error);
            status.textContent = 'Gagal memuat halaman materi.';
        }
    }
});
</script>
@endsection
