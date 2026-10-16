@extends('admin.layout')

@section('title', 'Data Peserta - Web Pelatihan')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        margin-bottom: 22px;
    }

    .page-description {
        color: #687f96;
        margin-top: 7px;
        font-size: 12px;
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
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        padding: 12px 15px;
        border: 1px solid #d6e0ec;
        border-radius: 7px;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .search-form input:focus {
        border-color: #3985d8;
        box-shadow: 0 0 0 3px #3985d81a;
    }

    .search-status {
        min-height: 18px;
        margin: -10px 0 12px;
        color: #687f96;
        font-size: 11px;
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
        padding: 15px 13px;
        text-align: left;
        border-bottom: 1px solid #edf1f6;
    }

    .participant-table th {
        background: #f3f7fc;
        color: #45627e;
        font-size: 12px;
        font-weight: 600;
    }

    .participant-table td {
        color: #536b83;
        font-size: 13px;
    }

    .participant-table tbody tr:hover {
        background: #f8fbff;
    }

    .btn-detail {
        display: inline-block;
        padding: 9px 13px;
        background: #327fc7;
        color: #fff;
        border-radius: 7px;
        text-decoration: none;
        font-size: 12px;
    }

    .btn-detail:hover {
        background: #246bad;
        color: #fff;
    }

    .empty-message {
        text-align: center !important;
        padding: 30px !important;
        color: #8293a5 !important;
    }

    .empty-message p {
        margin: 8px 0 0;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination nav p {
        font-size: 12px;
        color: #687f96;
    }

    #hasilPeserta {
        transition: opacity .15s;
    }

    #hasilPeserta.loading {
        opacity: .5;
        pointer-events: none;
    }

    @media (max-width: 600px) {
        .data-card {
            padding: 12px;
        }

        .page-header h1 {
            font-size: 18px;
        }

        .search-form input {
            font-size: 12px;
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
</div>

<div class="data-card">

    <div class="search-form">
        <input
            type="search"
            id="cariPeserta"
            placeholder="Cari nama atau email peserta..."
            value="{{ request('cari') }}"
            aria-label="Cari nama atau email peserta"
            autocomplete="off"
        >
    </div>

    <div
        id="statusPencarian"
        class="search-status"
        role="status"
        aria-live="polite"
    ></div>

    <div id="hasilPeserta">
        @include('admin.peserta.partials.table')
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('cariPeserta');
    const hasil = document.getElementById('hasilPeserta');
    const status = document.getElementById('statusPencarian');

    if (!input || !hasil || !status) return;

    let timer = null;
    let controller = null;

    async function cariPeserta(url) {
        if (controller) {
            controller.abort();
        }

        const requestController = new AbortController();
        controller = requestController;

        hasil.classList.add('loading');
        status.textContent = 'Mencari peserta...';

        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: requestController.signal
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data peserta.');
            }

            const html = await response.text();

            if (controller !== requestController) return;

            hasil.innerHTML = html;

            status.textContent = input.value.trim()
                ? 'Hasil pencarian diperbarui.'
                : '';

            const currentUrl = new URL(window.location.href);
            const keyword = input.value.trim();

            if (keyword) {
                currentUrl.searchParams.set('cari', keyword);
            } else {
                currentUrl.searchParams.delete('cari');
            }

            currentUrl.searchParams.delete('page');

            window.history.replaceState({}, '', currentUrl);

        } catch (error) {
            if (error.name !== 'AbortError') {
                status.textContent =
                    'Terjadi kesalahan. Silakan coba lagi.';
                console.error(error);
            }
        } finally {
            if (controller === requestController) {
                controller = null;
                hasil.classList.remove('loading');
            }
        }
    }

    function buatUrl(page = null) {
        const url = new URL(
            '{{ route("admin.peserta.index") }}',
            window.location.origin
        );

        const keyword = input.value.trim();

        if (keyword) {
            url.searchParams.set('cari', keyword);
        }

        if (page) {
            url.searchParams.set('page', page);
        }

        return url.toString();
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);

        timer = setTimeout(function () {
            cariPeserta(buatUrl());
        }, 300);
    });

    hasil.addEventListener('click', function (event) {
        const link = event.target.closest('.pagination a');

        if (!link) return;

        event.preventDefault();

        const linkUrl = new URL(link.href);
        const page = linkUrl.searchParams.get('page');

        cariPeserta(buatUrl(page));
    });
});
</script>

@endsection
