
@extends('layouts.peserta')

@section('title', 'Materi Pelatihan')

@section('content')

<style>
    .materi-heading {
        margin-bottom: 28px;
    }

    .materi-heading h1 {
        color: #16386f;
        font-size: clamp(27px, 3vw, 36px);
        font-weight: 800;
        letter-spacing: -.8px;
        margin-bottom: 12px;
    }

    .materi-heading p {
        color: var(--muted);
        font-size: 16px;
        line-height: 1.7;
    }

    .materi-search {
        display: flex;
        width: min(100%, 650px);
        gap: 10px;
        margin-top: 22px;
    }

    .materi-search input {
        flex: 1;
        min-width: 0;
        min-height: 52px;
        padding: 12px 17px;
        border: 1px solid #d5e2f3;
        border-radius: 10px;
        background: rgba(255,255,255,.95);
        color: var(--text);
        outline: none;
    }

    .materi-search input:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px #3987f41a;
    }

    .materi-search button {
        border: 0;
        padding: 0 22px;
        border-radius: 10px;
        background: #2878e8;
        color: white;
        font-weight: 700;
        cursor: pointer;
    }

    .materi-search button:hover {
        background: #1d65c8;
    }

    .materi-search button:disabled {
        opacity: .65;
        cursor: wait;
    }

    .materi-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 25px 0 32px;
    }

    .materi-filter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 17px;
        border-radius: 9px;
        background: #e7effb;
        color: #45627e;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .materi-filter:hover,
    .materi-filter.active {
        color: white;
        background: #2878e8;
    }

    .materi-section-title {
        color: #16386f;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 22px;
    }

    .materi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px 22px;
    }

    .materi-card {
        display: block;
        min-width: 0;
        color: inherit;
        border-radius: 15px;
        transition: transform .2s;
    }

    .materi-card:hover {
        transform: translateY(-3px);
    }

    .materi-thumbnail {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 14px;
        margin-bottom: 14px;
        background: linear-gradient(135deg, #d8f5ff, #e5eaff);
    }

    .materi-thumbnail img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .materi-placeholder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 12px;
        width: 100%;
        height: 100%;
        color: #2878e8;
        background: linear-gradient(135deg, #d8f5ff, #e5eaff);
    }

    .materi-placeholder .placeholder-icon {
        font-size: 43px;
        line-height: 1;
    }

    .materi-placeholder strong {
        font-size: 17px;
        text-align: center;
        padding: 0 12px;
    }

    .materi-play {
        position: absolute;
        right: 11px;
        bottom: 11px;
        padding: 7px 10px;
        border-radius: 7px;
        color: white;
        background: rgba(15, 35, 65, .85);
        font-size: 12px;
        font-weight: 600;
    }

    .materi-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .materi-avatar {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #dcecff;
        color: #2878e8;
        font-size: 21px;
    }

    .materi-info-text {
        flex: 1;
        min-width: 0;
    }

    .materi-info-text h3 {
        color: #18345d;
        font-size: 16px;
        line-height: 1.5;
        font-weight: 800;
        overflow-wrap: anywhere;
        margin-bottom: 7px;
    }

    .materi-info-text p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .materi-type {
        display: inline-block;
        margin-top: 8px;
        padding: 6px 9px;
        border-radius: 7px;
        background: #e4efff;
        color: #2866a5;
        font-size: 11px;
        font-weight: 700;
    }

    .materi-empty {
        grid-column: 1 / -1;
        padding: 48px 20px;
        text-align: center;
        background: rgba(255,255,255,.94);
        border: 1px solid var(--border);
        border-radius: 16px;
        color: var(--muted);
    }

    .materi-empty .empty-icon {
        font-size: 42px;
        margin-bottom: 12px;
    }

    .materi-empty h3 {
        color: #16386f;
        font-size: 19px;
        margin-bottom: 9px;
    }

    .materi-empty p {
        font-size: 14px;
        line-height: 1.7;
    }

    .materi-loading {
        opacity: .5;
        pointer-events: none;
        transition: opacity .15s;
    }

    .materi-pagination {
        margin-top: 30px;
        overflow-x: auto;
    }

    .materi-pagination nav > div:first-child {
        margin-bottom: 12px;
    }

    .materi-pagination nav > div:last-child {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .materi-pagination nav a,
    .materi-pagination nav span[aria-current] span,
    .materi-pagination nav span[aria-disabled] span {
        display: inline-block;
        padding: 9px 13px;
        border-radius: 8px;
        background: white;
        border: 1px solid var(--border);
        font-size: 13px;
    }

    @media (max-width: 1150px) {
        .materi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .materi-heading p {
            font-size: 14px;
        }

        .materi-search {
            width: 100%;
        }

        .materi-search button {
            padding: 0 15px;
        }

        .materi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 14px;
        }

        .materi-section-title {
            font-size: 22px;
        }

        .materi-avatar {
            width: 35px;
            height: 35px;
            font-size: 17px;
        }

        .materi-info {
            gap: 8px;
        }

        .materi-info-text h3 {
            font-size: 14px;
        }

        .materi-info-text p {
            font-size: 12px;
        }

        .materi-type {
            font-size: 10px;
        }
    }

    @media (max-width: 420px) {
        .materi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="materi-heading">
    <h1>Materi Pelatihan</h1>
    <p>Belajar melalui video, gambar, dan materi visual yang mudah dipahami.</p>

    <form action="{{ route('peserta.materi.index') }}"
          method="GET"
          class="materi-search"
          id="searchForm">

        <input type="search"
               name="cari"
               id="searchInput"
               value="{{ $cari ?? request('cari', '') }}"
               placeholder="Cari materi pelatihan..."
               autocomplete="off"
               aria-label="Cari materi pelatihan">

        <button type="submit" id="searchButton">⌕ Cari</button>
    </form>
</section>

{{-- Hasil pencarian diperbarui melalui AJAX --}}
<div id="materiResults">
    @include('peserta.materi.hasil')
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    const form = document.getElementById('searchForm');
    const results = document.getElementById('materiResults');
    const button = document.getElementById('searchButton');

    if (!input || !form || !results) return;

    let timer = null;
    let controller = null;
    let requestNumber = 0;

    async function cariMateri() {
        const keyword = input.value.trim();
        const currentRequest = ++requestNumber;

        if (controller) {
            controller.abort();
        }

        controller = new AbortController();

        const url = new URL(form.action, window.location.origin);

        if (keyword) {
            url.searchParams.set('cari', keyword);
        } else {
            url.searchParams.delete('cari');
        }

        url.searchParams.delete('page');

        results.classList.add('materi-loading');
        button.disabled = true;

        try {
            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                signal: controller.signal
            });

            if (!response.ok) {
                throw new Error('Gagal memuat hasil pencarian.');
            }

            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newResults = doc.getElementById('materiResults');

            if (currentRequest !== requestNumber) return;

            if (!newResults) {
                throw new Error('Bagian hasil materi tidak ditemukan.');
            }

            results.innerHTML = newResults.innerHTML;

            // Simpan kata kunci di URL tanpa reload halaman.
            window.history.replaceState({}, '', url.toString());

        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error(error);
            }
        } finally {
            if (currentRequest === requestNumber) {
                results.classList.remove('materi-loading');
                button.disabled = false;
            }
        }
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(cariMateri, 300);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearTimeout(timer);
        cariMateri();
    });

    // Klik kategori tetap bekerja setelah hasil diperbarui.
    results.addEventListener('click', function (event) {
        const link = event.target.closest('.materi-filter');

        if (!link) return;

        event.preventDefault();

        const url = new URL(link.href, window.location.origin);
        input.value = url.searchParams.get('cari') || '';

        clearTimeout(timer);
        cariMateri();
    });

    // Pagination juga tetap berfungsi tanpa reload penuh.
    results.addEventListener('click', function (event) {
        const link = event.target.closest('.materi-pagination a');

        if (!link) return;

        event.preventDefault();

        const url = new URL(link.href, window.location.origin);
        const keyword = url.searchParams.get('cari') || '';

        input.value = keyword;
        muatHalaman(url);
    });

    async function muatHalaman(url) {
        if (controller) controller.abort();

        controller = new AbortController();
        const currentRequest = ++requestNumber;

        results.classList.add('materi-loading');

        try {
            const response = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                signal: controller.signal
            });

            if (!response.ok) {
                throw new Error('Gagal memuat halaman materi.');
            }

            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newResults = doc.getElementById('materiResults');

            if (currentRequest !== requestNumber) return;

            if (newResults) {
                results.innerHTML = newResults.innerHTML;
                window.history.replaceState({}, '', url.toString());
            }
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error(error);
            }
        } finally {
            if (currentRequest === requestNumber) {
                results.classList.remove('materi-loading');
            }
        }
    }
});
</script>
@endpush
