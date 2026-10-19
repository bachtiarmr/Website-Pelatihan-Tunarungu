
@extends('layouts.peserta')

@section('title', $materi->judul)

@push('styles')
<style>
    .materi-detail {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
    }

    .materi-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 25px;
        color: #2878e8;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .materi-back:hover {
        color: #153e75;
        transform: translateX(-3px);
    }

    .materi-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 350px;
        gap: 28px;
        align-items: start;
    }

    .materi-player {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 16px;
        background: #e8f1ff;
        border: 1px solid var(--border, #dbe5f1);
        box-shadow: 0 5px 20px rgba(30, 80, 140, .07);
    }

    .materi-player iframe,
    .materi-player video,
    .materi-player > img {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .materi-player iframe,
    .materi-player video {
        object-fit: contain;
        background: #101827;
    }

    .materi-player > img {
        object-fit: contain;
        background: #fff;
    }

    .materi-placeholder {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 25px;
        text-align: center;
        background: linear-gradient(135deg, #e3efff, #f8fbff);
        box-sizing: border-box;
    }

    .materi-placeholder-inner {
        max-width: 440px;
    }

    .materi-placeholder-icon {
        width: 78px;
        height: 78px;
        margin: 0 auto 18px;
        display: grid;
        place-items: center;
        border-radius: 22px;
        background: #d5e7ff;
        color: var(--blue, #2878e8);
    }

    .materi-placeholder-icon svg {
        width: 40px;
        height: 40px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .materi-placeholder h2 {
        margin: 0 0 10px;
        color: var(--blue-dark, #153e75);
        font-size: 23px;
        line-height: 1.4;
    }

    .materi-placeholder p {
        color: var(--muted, #64748b);
        font-size: 14px;
        line-height: 1.8;
    }

    .materi-info {
        margin-top: 20px;
        padding: 28px;
        background: rgba(255, 255, 255, .96);
        border: 1px solid var(--border, #dbe5f1);
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(46, 91, 139, .04);
    }

    .materi-title {
        margin: 0 0 13px;
        color: #16386f;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -.6px;
        overflow-wrap: anywhere;
    }

    .materi-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 22px;
        color: var(--muted, #64748b);
        font-size: 14px;
        line-height: 1.7;
    }

    .materi-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 30px;
        background: #e8f2ff;
        color: #2267c5;
        font-size: 12px;
        font-weight: 700;
    }

    .materi-description {
        color: #29466f;
        font-size: 15px;
        line-height: 1.95;
        overflow-wrap: anywhere;
    }

    .materi-description p {
        margin-bottom: 12px;
    }

    .materi-description p:last-child {
        margin-bottom: 0;
    }

    .materi-empty-description {
        color: var(--muted, #64748b);
    }

    .materi-related {
        padding: 24px;
        background: rgba(255, 255, 255, .96);
        border: 1px solid var(--border, #dbe5f1);
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(46, 91, 139, .04);
    }

    .materi-related-heading {
        margin: 0 0 20px;
        color: #16386f;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.4;
    }

    .materi-related-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .materi-related-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 8px;
        border-radius: 11px;
        text-decoration: none;
        transition: background .2s;
    }

    .materi-related-item:hover {
        background: #f0f6ff;
    }

    .materi-related-thumb {
        display: grid;
        place-items: center;
        width: 112px;
        aspect-ratio: 16 / 9;
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 9px;
        background: #dceeff;
        color: var(--blue, #2878e8);
    }

    .materi-related-thumb img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .materi-related-thumb svg {
        width: 27px;
        height: 27px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .materi-related-info {
        flex: 1;
        min-width: 0;
    }

    .materi-related-title {
        margin: 0;
        color: #18345d;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .materi-related-category {
        margin: 5px 0 0;
        color: var(--muted, #64748b);
        font-size: 12px;
        line-height: 1.6;
    }

    .materi-related-type {
        display: inline-block;
        margin-top: 7px;
        padding: 4px 7px;
        border-radius: 5px;
        background: #edf4ff;
        color: #52719b;
        font-size: 10px;
        font-weight: 600;
    }

    .materi-related-empty {
        padding: 20px 12px;
        text-align: center;
        color: var(--muted, #64748b);
        font-size: 13px;
        line-height: 1.8;
        background: #f6f9ff;
        border-radius: 10px;
    }

    @media (max-width: 1250px) {
        .materi-grid {
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 20px;
        }

        .materi-related {
            padding: 18px;
        }

        .materi-related-thumb {
            width: 90px;
        }
    }

    @media (max-width: 1000px) {
        .materi-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .materi-related {
            margin-top: 0;
        }

        .materi-related-item {
            max-width: 550px;
        }

        .materi-related-thumb {
            width: 120px;
        }
    }

    @media (max-width: 760px) {
        .materi-back {
            margin-bottom: 19px;
            font-size: 13px;
        }

        .materi-player {
            border-radius: 12px;
        }

        .materi-info {
            margin-top: 14px;
            padding: 20px;
            border-radius: 13px;
        }

        .materi-title {
            font-size: 25px;
        }

        .materi-meta {
            font-size: 12px;
            gap: 8px;
        }

        .materi-description {
            font-size: 14px;
        }

        .materi-related {
            padding: 18px;
            border-radius: 13px;
        }

        .materi-related-heading {
            font-size: 19px;
        }

        .materi-placeholder h2 {
            font-size: 19px;
        }

        .materi-placeholder p {
            font-size: 12px;
        }
    }

    @media (max-width: 420px) {
        .materi-related-thumb {
            width: 95px;
        }

        .materi-info {
            padding: 16px;
        }

        .materi-related {
            padding: 13px;
        }
    }
</style>
@endpush

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Mengambil ID video YouTube
    |--------------------------------------------------------------------------
    | Mendukung:
    | youtube.com/watch?v=ID
    | youtu.be/ID
    | youtube.com/embed/ID
    | youtube.com/shorts/ID
    | youtube.com/live/ID
    */

    $youtubeId = null;

    if (!empty($materi->video_url)) {
        $url = trim($materi->video_url);

        // Menambahkan protokol jika admin memasukkan URL tanpa https://
        if (!preg_match('~^https?://~i', $url)) {
            $url = 'https://' . $url;
        }

        $parsedUrl = parse_url($url);
        $host = strtolower($parsedUrl['host'] ?? '');
        $path = trim($parsedUrl['path'] ?? '', '/');

        if (
            $host === 'youtu.be' ||
            str_ends_with($host, '.youtu.be')
        ) {
            $youtubeId = explode('/', $path)[0] ?? null;
        } elseif (
            $host === 'youtube.com' ||
            str_ends_with($host, '.youtube.com') ||
            $host === 'youtube-nocookie.com' ||
            str_ends_with($host, '.youtube-nocookie.com')
        ) {
            parse_str($parsedUrl['query'] ?? '', $queryParams);

            if (!empty($queryParams['v'])) {
                $youtubeId = $queryParams['v'];
            } elseif (
                preg_match(
                    '~(?:embed|shorts|live)/([^/?]+)~',
                    $path,
                    $matches
                )
            ) {
                $youtubeId = $matches[1];
            }
        }

        // ID YouTube normalnya terdiri dari 11 karakter
        if (
            !$youtubeId ||
            !preg_match('/^[a-zA-Z0-9_-]{11}$/', $youtubeId)
        ) {
            $youtubeId = null;
        }
    }

    $fotoUrl = $materi->foto
        ? \Illuminate\Support\Facades\Storage::disk('public')->url($materi->foto)
        : null;

    $videoUrl = $materi->video_file
        ? \Illuminate\Support\Facades\Storage::disk('public')->url($materi->video_file)
        : null;
@endphp

<div class="materi-detail">

    <a href="{{ route('peserta.materi.index') }}" class="materi-back">
        <svg width="20" height="20" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round"
             aria-hidden="true">
            <path d="m15 18-6-6 6-6"/>
            <path d="M9 12h12"/>
        </svg>
        Kembali ke semua materi
    </a>

    <div class="materi-grid">

        {{-- KOLOM MATERI UTAMA --}}
        <section>

            {{-- VIDEO YOUTUBE --}}
            @if ($materi->jenis === 'youtube' && $youtubeId)

                <div class="materi-player">
                    <iframe
                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                        title="{{ $materi->judul }}"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>

            {{-- JENIS YOUTUBE TETAPI LINK TIDAK VALID --}}
            @elseif ($materi->jenis === 'youtube')

                <div class="materi-player materi-placeholder">
                    <div class="materi-placeholder-inner">
                        <div class="materi-placeholder-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v5"/>
                                <path d="M12 16h.01"/>
                            </svg>
                        </div>

                        <h2>Video belum dapat diputar</h2>
                        <p>
                            Link YouTube pada materi ini tidak valid.
                            Silakan hubungi admin untuk memeriksa kembali
                            link video yang disimpan.
                        </p>
                    </div>
                </div>

            {{-- VIDEO UNGGAHAN ADMIN --}}
            @elseif ($materi->jenis === 'upload_video' && $videoUrl)

                <div class="materi-player">
                    <video
                        controls
                        playsinline
                        preload="metadata"
                        @if ($fotoUrl) poster="{{ $fotoUrl }}" @endif>
                        <source src="{{ $videoUrl }}">
                        Browser kamu tidak mendukung pemutaran video.
                    </video>
                </div>

            {{-- FOTO MATERI --}}
            @elseif ($fotoUrl)

                <div class="materi-player">
                    <img
                        src="{{ $fotoUrl }}"
                        alt="Gambar materi {{ $materi->judul }}">
                </div>

            {{-- MATERI TANPA MEDIA --}}
            @else

                <div class="materi-player materi-placeholder">
                    <div class="materi-placeholder-inner">
                        <div class="materi-placeholder-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 4h16v16H4z"/>
                                <path d="M8 8h8M8 12h8M8 16h5"/>
                            </svg>
                        </div>

                        <h2>Materi Pembelajaran</h2>
                        <p>
                            Pelajari materi berikut melalui penjelasan
                            yang tersedia di bawah ini.
                        </p>
                    </div>
                </div>

            @endif

            {{-- INFORMASI MATERI --}}
            <div class="materi-info">

                <h1 class="materi-title">
                    {{ $materi->judul }}
                </h1>

                <div class="materi-meta">
                    <span>
                        Kategori: {{ $materi->kategori ?: 'Umum' }}
                    </span>

                    <span aria-hidden="true">•</span>

                    <span class="materi-badge">
                        @switch($materi->jenis)
                            @case('youtube')
                                Video YouTube
                                @break

                            @case('upload_video')
                                Video pembelajaran
                                @break

                            @default
                                Teks dan gambar
                        @endswitch
                    </span>
                </div>

                @if ($materi->deskripsi)
                    <div class="materi-description">
                        {!! nl2br(e($materi->deskripsi)) !!}
                    </div>
                @else
                    <p class="materi-description materi-empty-description">
                        Belum ada deskripsi untuk materi ini.
                        Silakan hubungi pengelola pelatihan jika membutuhkan
                        informasi tambahan.
                    </p>
                @endif

            </div>
        </section>

        {{-- SIDEBAR MATERI LAINNYA --}}
        <aside class="materi-related">

            <h2 class="materi-related-heading">Materi lainnya</h2>

            <div class="materi-related-list">

                @forelse ($materiLainnya as $item)

                    @php
                        $itemFotoUrl = $item->foto
                            ? \Illuminate\Support\Facades\Storage::disk('public')->url($item->foto)
                            : null;
                    @endphp

                    <a
                        href="{{ route('peserta.materi.show', $item->id) }}"
                        class="materi-related-item">

                        <div class="materi-related-thumb">

                            @if ($itemFotoUrl)

                                <img
                                    src="{{ $itemFotoUrl }}"
                                    alt="Thumbnail {{ $item->judul }}"
                                    loading="lazy">

                            @elseif (
                                in_array($item->jenis, ['youtube', 'upload_video'])
                            )

                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <polygon
                                        points="5 3 19 12 5 21 5 3"
                                        fill="currentColor"
                                        stroke="none"/>
                                </svg>

                            @else

                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 4h16v16H4z"/>
                                    <path d="M8 8h8M8 12h8M8 16h5"/>
                                </svg>

                            @endif

                        </div>

                        <div class="materi-related-info">

                            <p class="materi-related-title">
                                {{ $item->judul }}
                            </p>

                            <p class="materi-related-category">
                                {{ $item->kategori ?: 'Umum' }}
                            </p>

                            <span class="materi-related-type">
                                @switch($item->jenis)
                                    @case('youtube')
                                        Video YouTube
                                        @break

                                    @case('upload_video')
                                        Video pembelajaran
                                        @break

                                    @default
                                        Teks dan gambar
                                @endswitch
                            </span>

                        </div>
                    </a>

                @empty

                    <div class="materi-related-empty">
                        Belum ada materi lainnya yang tersedia.
                    </div>

                @endforelse

            </div>
        </aside>

    </div>
</div>

@endsection
