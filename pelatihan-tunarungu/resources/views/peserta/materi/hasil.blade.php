
{{-- resources/views/peserta/materi/hasil.blade.php --}}

<style>
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
        text-decoration: none;
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
        overflow-wrap: anywhere;
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
        text-decoration: none;
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

    .materi-thumbnail > img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .materi-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 12px;
        padding: 12px;
        color: #2878e8;
        background: linear-gradient(135deg, #d8f5ff, #e5eaff);
        text-align: center;
    }

    .materi-placeholder .placeholder-icon {
        font-size: 43px;
        line-height: 1;
    }

    .materi-placeholder strong {
        font-size: 17px;
        overflow-wrap: anywhere;
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
        pointer-events: none;
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
        margin: 0 0 7px;
    }

    .materi-info-text p {
        color: var(--muted, #6480a6);
        font-size: 13px;
        line-height: 1.7;
        overflow-wrap: anywhere;
        margin: 0;
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
        border: 1px solid var(--border, #dce9fb);
        border-radius: 16px;
        color: var(--muted, #6480a6);
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
        border: 1px solid var(--border, #dce9fb);
        font-size: 13px;
    }

    .materi-loading {
        opacity: .5;
        pointer-events: none;
        transition: opacity .15s;
    }

    @media (max-width: 1150px) {
        .materi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
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

        .materi-placeholder .placeholder-icon {
            font-size: 30px;
        }

        .materi-placeholder strong {
            font-size: 13px;
        }
    }

    @media (max-width: 420px) {
        .materi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- Filter kategori --}}
@if (isset($kategoriMateri) && $kategoriMateri->isNotEmpty())
    <div class="materi-filters">
        <a
            href="{{ route('peserta.materi.index') }}"
            class="materi-filter {{ request('kategori') ? '' : 'active' }}">
            Semua Materi
        </a>

        @foreach ($kategoriMateri as $kategori)
            <a
                href="{{ route('peserta.materi.index', array_filter([
                    'kategori' => $kategori,
                    'cari' => request('cari'),
                ])) }}"
                class="materi-filter {{ request('kategori') === $kategori ? 'active' : '' }}">
                {{ $kategori }}
            </a>
        @endforeach
    </div>
@endif

<h2 class="materi-section-title">
    @if (request('cari'))
        Hasil pencarian: "{{ request('cari') }}"
    @elseif (request('kategori'))
        Materi {{ request('kategori') }}
    @else
        Semua Materi
    @endif
</h2>

<div class="materi-grid">
    @forelse ($materi as $item)

        @php
            /*
             * Mengubah nilai foto menjadi URL publik.
             * Mendukung:
             * materi/foto/gambar.jpg
             * public/materi/foto/gambar.jpg
             * storage/materi/foto/gambar.jpg
             * URL gambar lengkap.
             */
            $fotoPath = trim((string) $item->foto);
            $fotoUrl = null;

            if ($fotoPath !== '') {
                if (filter_var($fotoPath, FILTER_VALIDATE_URL)) {
                    $fotoUrl = $fotoPath;
                } else {
                    $fotoPath = ltrim($fotoPath, '/');

                    $fotoPath = preg_replace(
                        '~^(public/|storage/)~',
                        '',
                        $fotoPath
                    );

                    $fotoUrl = asset(
                        'storage/' . $fotoPath
                    );
                }
            }

            /*
             * Mengambil ID video YouTube untuk thumbnail otomatis.
             */
            $youtubeId = null;

            if ($item->jenis === 'youtube' && $item->video_url) {
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

            $youtubeThumbnail = $youtubeId
                ? 'https://img.youtube.com/vi/' . $youtubeId . '/hqdefault.jpg'
                : null;

            $isVideo = in_array(
                $item->jenis,
                ['youtube', 'upload_video']
            );
        @endphp

        <a
            href="{{ route('peserta.materi.show', $item->id) }}"
            class="materi-card">

            <div class="materi-thumbnail">

                {{-- Foto sampul yang diunggah admin --}}
                @if ($fotoUrl)

                    <img
                        src="{{ $fotoUrl }}"
                        alt="Sampul {{ $item->judul }}"
                        loading="lazy"
                        onerror="this.onerror=null; this.style.display='none'; const p=this.parentElement.querySelector('.materi-placeholder'); if(p) p.style.display='flex';">

                    <div
                        class="materi-placeholder"
                        style="display:none;">
                        <span class="placeholder-icon">
                            {{ $isVideo ? '▶' : '▤' }}
                        </span>
                        <strong>{{ $item->judul }}</strong>
                    </div>

                {{-- Thumbnail YouTube jika foto sampul tidak diisi --}}
                @elseif ($youtubeThumbnail)

                    <img
                        src="{{ $youtubeThumbnail }}"
                        alt="Thumbnail video {{ $item->judul }}"
                        loading="lazy"
                        onerror="this.onerror=null; this.style.display='none'; const p=this.parentElement.querySelector('.materi-placeholder'); if(p) p.style.display='flex';">

                    <div
                        class="materi-placeholder"
                        style="display:none;">
                        <span class="placeholder-icon">▶</span>
                        <strong>{{ $item->judul }}</strong>
                    </div>

                {{-- Placeholder jika tidak ada gambar --}}
                @else

                    <div class="materi-placeholder">
                        <span class="placeholder-icon">
                            {{ $isVideo ? '▶' : '▤' }}
                        </span>
                        <strong>{{ $item->judul }}</strong>
                    </div>

                @endif

                @if ($isVideo)
                    <span class="materi-play">▶ Video</span>
                @endif
            </div>

            <div class="materi-info">
                <div class="materi-avatar" aria-hidden="true">
                    ▤
                </div>

                <div class="materi-info-text">
                    <h3>{{ $item->judul }}</h3>

                    <p>Web Pelatihan</p>

                    @if ($item->kategori)
                        <p>{{ $item->kategori }}</p>
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
                                Teks dan Gambar
                        @endswitch
                    </span>
                </div>
            </div>
        </a>

    @empty
        <div class="materi-empty">
            <div class="empty-icon">📚</div>

            <h3>Materi tidak ditemukan</h3>

            @if (request('cari'))
                <p>
                    Tidak ada materi yang cocok dengan pencarian
                    "{{ request('cari') }}". Coba kata kunci lain.
                </p>
            @elseif (request('kategori'))
                <p>
                    Belum ada materi pada kategori
                    "{{ request('kategori') }}".
                </p>
            @else
                <p>Belum ada materi pelatihan yang dipublikasikan.</p>
            @endif
        </div>
    @endforelse
</div>

@if ($materi->hasPages())
    <div class="materi-pagination">
        {{ $materi->withQueryString()->links() }}
    </div>
@endif
