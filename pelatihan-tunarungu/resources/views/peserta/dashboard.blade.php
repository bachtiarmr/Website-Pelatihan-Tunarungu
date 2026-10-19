@extends('layouts.peserta')

@section('title', 'Beranda')

@section('content')

<section class="welcome dashboard-welcome">
    <h1>
        Halo, {{ auth()->user()->name }} 👋
    </h1>
    <p>Selamat datang di platform pelatihan!</p>
</section>

{{-- STATISTIK --}}
<section class="stats dashboard-stats">

    <div class="panel stat-card">
        <div class="stat-icon stat-blue">
            <svg class="icon" viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>
        <p>Materi Tersedia</p>
        <div class="stat-number">{{ $totalMateri }}</div>
        <span>Modul pelatihan dipublikasikan</span>
    </div>

    <div class="panel stat-card stat-green-card">
        <div class="stat-icon stat-green">
            <svg class="icon" viewBox="0 0 24 24">
                <path d="M3 3v18h18"/>
                <path d="m19 9-5 5-4-4-3 3"/>
            </svg>
        </div>
        <p>Progres Belajar</p>
        <div class="stat-number">0%</div>
        <span>Progres belajar kamu</span>
    </div>

    <div class="panel stat-card stat-purple-card">
        <div class="stat-icon stat-purple">
            <svg class="icon" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <path d="m9 11 3 3L22 4"/>
            </svg>
        </div>
        <p>Evaluasi Selesai</p>
        <div class="stat-number">0</div>
        <span>Evaluasi yang telah diselesaikan</span>
    </div>

    <div class="panel stat-card stat-orange-card">
        <div class="stat-icon stat-orange">
            <svg class="icon" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="6"/>
                <path d="m15.477 12.89 1.523 9.11-5-3-5 3 1.523-9.11"/>
            </svg>
        </div>
        <p>Kompetensi</p>
        <div class="stat-number">0</div>
        <span>Kompetensi diperoleh</span>
    </div>

</section>

{{-- PELATIHAN TERBARU --}}
<section id="materi" class="dashboard-materi-section">

    <div class="section-header">
        <div>
            <h2 class="section-heading">Pelatihan Terbaru</h2>
            <p class="section-subtitle">
                Yuk, lanjutkan belajar dan tingkatkan kompetensimu!
            </p>
        </div>

        <a href="{{ route('peserta.materi.index') }}" class="see-all">
            Lihat Semua Materi →
        </a>
    </div>

    @forelse ($materiTerbaru as $item)

        @php
            /*
            |--------------------------------------------------------------------------
            | URL FOTO MATERI
            |--------------------------------------------------------------------------
            | Menggunakan asset() agar URL mengikuti host website yang dibuka.
            */

            $thumbnail = null;

            if (!empty($item->foto)) {
                $thumbnail = asset(
                    'storage/' . ltrim($item->foto, '/')
                );
            }

            /*
            |--------------------------------------------------------------------------
            | MENGAMBIL ID VIDEO YOUTUBE
            |--------------------------------------------------------------------------
            */

            $youtubeId = null;

            if (
                $item->jenis === 'youtube' &&
                !empty($item->video_url)
            ) {
                $parsedUrl = parse_url($item->video_url);
                $host = strtolower($parsedUrl['host'] ?? '');
                $path = trim($parsedUrl['path'] ?? '', '/');

                if (str_contains($host, 'youtu.be')) {
                    $youtubeId = explode('/', $path)[0] ?? null;
                } elseif (
                    str_contains($host, 'youtube.com') ||
                    str_contains($host, 'youtube-nocookie.com')
                ) {
                    parse_str($parsedUrl['query'] ?? '', $params);

                    $youtubeId = $params['v'] ?? null;

                    if (
                        !$youtubeId &&
                        preg_match(
                            '~(?:embed|shorts)/([^/?]+)~',
                            $path,
                            $matches
                        )
                    ) {
                        $youtubeId = $matches[1];
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | FALLBACK THUMBNAIL YOUTUBE
            |--------------------------------------------------------------------------
            | Foto materi tetap diprioritaskan.
            | Thumbnail YouTube digunakan jika foto tidak tersedia.
            */

            if (!$thumbnail && $youtubeId) {
                $thumbnail = 'https://img.youtube.com/vi/'
                    . $youtubeId
                    . '/hqdefault.jpg';
            }

            $isVideo = in_array(
                $item->jenis,
                ['youtube', 'upload_video'],
                true
            );

            $jenisMateri = match ($item->jenis) {
                'youtube' => 'Video YouTube',
                'upload_video' => 'Video Pembelajaran',
                default => 'Teks / Foto',
            };
        @endphp

        <article class="panel materi-card">

            {{-- THUMBNAIL MATERI --}}
            <a
                href="{{ route('peserta.materi.show', $item->id) }}"
                class="materi-thumbnail"
                aria-label="Pelajari {{ $item->judul }}"
            >

                @if ($thumbnail)
                    <img
                        src="{{ $thumbnail }}"
                        alt="Thumbnail {{ $item->judul }}"
                        loading="lazy"
                        onerror="
                            this.style.display='none';
                            this.nextElementSibling.style.display='flex';
                        "
                    >

                    <div class="thumbnail-placeholder" style="display:none;">
                        <svg class="icon placeholder-book" viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        <span>{{ $item->judul }}</span>
                    </div>
                @else
                    <div class="thumbnail-placeholder">
                        <svg class="icon placeholder-book" viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        <span>{{ $item->judul }}</span>
                    </div>
                @endif

                @if ($isVideo)
                    <span class="video-badge">▶ Video</span>
                @endif

            </a>

            {{-- INFORMASI MATERI --}}
            <div class="materi-info">

                <h3>
                    <a href="{{ route('peserta.materi.show', $item->id) }}">
                        {{ $item->judul }}
                    </a>
                </h3>

                <p class="materi-category">
                    Kategori: {{ $item->kategori ?: 'Umum' }}
                </p>

                @if (!empty($item->deskripsi))
                    <p class="materi-description">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 120) }}
                    </p>
                @endif

                <span class="materi-type">
                    @switch($item->jenis)
                        @case('youtube')
                            Video YouTube
                            @break

                        @case('upload_video')
                            Video Pembelajaran
                            @break

                        @default
                            Teks / Foto
                    @endswitch
                </span>

            </div>

            {{-- TOMBOL PELAJARI --}}
            <a
                href="{{ route('peserta.materi.show', $item->id) }}"
                class="primary-button materi-button"
            >
                ▶ Pelajari
            </a>

        </article>

    @empty

        <div class="empty-state">
            <div class="empty-state-icon">📚</div>
            <h3>Belum Ada Materi Pelatihan</h3>
            <p>
                Materi akan muncul di sini setelah admin menambahkan
                dan memublikasikannya.
            </p>
        </div>

    @endforelse

</section>

@endsection

@push('styles')
<style>
    /* HEADER */
    .dashboard-welcome {
        margin-bottom: 35px;
    }

    .dashboard-welcome h1 {
        margin-bottom: 12px;
        color: #16386f;
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 800;
        letter-spacing: -.8px;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .dashboard-welcome p {
        margin: 0;
        color: var(--muted);
        font-size: 16px;
        line-height: 1.7;
    }

    /* STATISTIK */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 42px;
    }

    .stat-card {
        min-width: 0;
        padding: 23px;
    }

    .stat-card > p {
        margin: 0 0 12px;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-card > span {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .stat-icon {
        display: grid;
        width: 55px;
        height: 55px;
        margin-bottom: 17px;
        place-items: center;
        border-radius: 50%;
    }

    .stat-icon .icon {
        width: 25px;
        height: 25px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .stat-blue {
        color: #2476dc;
        background: #dcecff;
    }

    .stat-green {
        color: #0c9c83;
        background: #d8f6ef;
    }

    .stat-purple {
        color: #6e54d9;
        background: #e9e2ff;
    }

    .stat-orange {
        color: #e99a20;
        background: #ffedca;
    }

    .stat-green-card {
        background: rgba(234, 251, 247, .9);
        border-color: #d5f2eb;
    }

    .stat-purple-card {
        background: rgba(242, 239, 255, .9);
        border-color: #e7e0ff;
    }

    .stat-orange-card {
        background: rgba(255, 248, 233, .92);
        border-color: #f8ead0;
    }

    .stat-number {
        margin-bottom: 10px;
        color: #16386f;
        font-size: 31px;
        font-weight: 800;
    }

    /* BAGIAN MATERI */
    .dashboard-materi-section {
        min-width: 0;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .section-heading {
        margin: 0 0 8px;
        color: #16386f;
        font-size: 23px;
        font-weight: 800;
    }

    .section-subtitle {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .see-all {
        flex-shrink: 0;
        color: #2476dc;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .see-all:hover {
        text-decoration: underline;
    }

    /* KARTU MATERI */
    .materi-card {
        display: flex;
        align-items: center;
        gap: 25px;
        min-width: 0;
        margin-bottom: 20px;
        padding: 22px;
        overflow: hidden;
    }

    .materi-thumbnail {
        position: relative;
        display: block;
        flex: 0 0 220px;
        width: 220px;
        height: 150px;
        overflow: hidden;
        border-radius: 12px;
        background: linear-gradient(135deg, #d8f5ff, #e8e8ff);
        text-decoration: none;
    }

    .materi-thumbnail > img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .25s ease;
    }

    .materi-card:hover .materi-thumbnail > img {
        transform: scale(1.04);
    }

    .thumbnail-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 15px;
        color: #2476dc;
        text-align: center;
        background: linear-gradient(135deg, #d8f5ff, #e8e8ff);
    }

    .thumbnail-placeholder .placeholder-book {
        width: 48px;
        height: 48px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .thumbnail-placeholder span {
        max-width: 100%;
        overflow-wrap: anywhere;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }

    .video-badge {
        position: absolute;
        right: 9px;
        bottom: 9px;
        padding: 6px 10px;
        border-radius: 6px;
        color: #fff;
        background: rgba(24, 36, 53, .88);
        font-size: 12px;
        font-weight: 700;
    }

    .materi-info {
        flex: 1;
        min-width: 0;
    }

    .materi-info h3 {
        margin: 0 0 9px;
        color: #16386f;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .materi-info h3 a {
        color: inherit;
        text-decoration: none;
    }

    .materi-info h3 a:hover {
        color: #2476dc;
    }

    .materi-category {
        margin: 0 0 12px;
        color: var(--muted);
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .materi-description {
        margin: 0 0 12px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .materi-type {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        color: #2866a5;
        background: #e8f1ff;
        font-size: 11px;
        font-weight: 700;
    }

    .materi-button {
        flex-shrink: 0;
        white-space: nowrap;
        text-decoration: none;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 40px 20px;
        border: 1px dashed #d5dfed;
        border-radius: 15px;
        background: #fff;
        text-align: center;
    }

    .empty-state-icon {
        margin-bottom: 12px;
        font-size: 42px;
    }

    .empty-state h3 {
        margin: 0 0 10px;
        color: #16386f;
        font-size: 19px;
    }

    .empty-state p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    /* TABLET */
    @media (max-width: 1150px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .materi-card {
            gap: 18px;
        }

        .materi-thumbnail {
            flex-basis: 190px;
            width: 190px;
            height: 135px;
        }
    }

    /* MOBILE */
    @media (max-width: 760px) {
        .dashboard-welcome {
            margin-bottom: 25px;
        }

        .dashboard-stats {
            gap: 12px;
            margin-bottom: 32px;
        }

        .stat-card {
            padding: 16px;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            margin-bottom: 13px;
        }

        .stat-number {
            font-size: 27px;
        }

        .section-header {
            align-items: flex-start;
            gap: 12px;
        }

        .section-heading {
            font-size: 20px;
        }

        .see-all {
            font-size: 11px;
            text-align: right;
        }

        .materi-card {
            flex-direction: column;
            align-items: stretch;
            gap: 17px;
            padding: 16px;
        }

        .materi-thumbnail {
            flex: none;
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
        }

        .materi-info {
            width: 100%;
        }

        .materi-info h3 {
            font-size: 19px;
        }

        .materi-button {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
    }

    @media (max-width: 400px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
        }

        .see-all {
            text-align: left;
        }
    }
</style>
@endpush
