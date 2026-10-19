@extends('admin.layout')

@section('title', 'Edit Materi - Web Pelatihan')

@section('content')
<style>
    .form-card {
        background: #fff;
        border: 1px solid #e7eef6;
        border-radius: 10px;
        padding: 24px;
        max-width: 850px;
    }

    .page-description {
        color: #687f96;
        margin-top: 7px;
        margin-bottom: 22px;
    }

    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #385773;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d6e0ec;
        border-radius: 7px;
        font-family: inherit;
        font-size: 12px;
        background: #fff;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .form-group small {
        display: block;
        color: #8293a5;
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .btn-save,
    .btn-cancel {
        display: inline-block;
        padding: 11px 16px;
        border: none;
        border-radius: 7px;
        text-decoration: none;
        font-family: inherit;
        font-size: 12px;
        cursor: pointer;
    }

    .btn-save {
        background: #327fc7;
        color: white;
    }

    .btn-cancel {
        background: #eaf0f7;
        color: #45627e;
    }

    .error-message {
        color: #c62828;
        font-size: 11px;
        margin-top: 5px;
    }

    .alert-error {
        background: #fdeaea;
        color: #b42323;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 18px;
    }

    .video-fields {
        display: none;
    }

    .video-fields.show {
        display: block;
    }

    .media-preview {
        margin-top: 12px;
        padding: 12px;
        border: 1px solid #e7eef6;
        border-radius: 8px;
        background: #f8fbff;
    }

    .media-preview img {
        display: block;
        width: 100%;
        max-width: 260px;
        max-height: 180px;
        object-fit: contain;
        border-radius: 6px;
        margin-top: 8px;
    }

    .media-preview a {
        color: #327fc7;
        overflow-wrap: anywhere;
    }
</style>

<h1 class="page-title">Edit Materi</h1>

<p class="page-description">
    Perbarui informasi materi pelatihan yang sudah tersimpan.
</p>

<div class="form-card">

    @if ($errors->any())
        <div class="alert-error">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul style="margin:8px 0 0 18px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.materi.update', $materi->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul Materi *</label>
            <input type="text"
                   id="judul"
                   name="judul"
                   value="{{ old('judul', $materi->judul) }}"
                   placeholder="Contoh: Pengenalan Microsoft Word"
                   required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori Pelatihan *</label>
            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih kategori --</option>

                @foreach ([
                    'Komputer',
                    'Komunikasi',
                    'Kesiapan Kerja',
                    'Administrasi',
                    'Kewirausahaan',
                    'Lainnya'
                ] as $kategori)
                    <option value="{{ $kategori }}"
                        @selected(old('kategori', $materi->kategori) === $kategori)>
                        {{ $kategori }}
                    </option>
                @endforeach

                @if (
                    $materi->kategori &&
                    !in_array($materi->kategori, [
                        'Komputer',
                        'Komunikasi',
                        'Kesiapan Kerja',
                        'Administrasi',
                        'Kewirausahaan',
                        'Lainnya'
                    ])
                )
                    <option value="{{ $materi->kategori }}"
                        @selected(old('kategori', $materi->kategori) === $materi->kategori)>
                        {{ $materi->kategori }}
                    </option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Materi</label>
            <textarea id="deskripsi"
                      name="deskripsi"
                      placeholder="Jelaskan isi dan tujuan materi...">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis Materi *</label>
            <select id="jenis" name="jenis" required>
                <option value="teks_foto"
                    @selected(old('jenis', $materi->jenis) === 'teks_foto')>
                    Teks dan Foto
                </option>

                <option value="youtube"
                    @selected(old('jenis', $materi->jenis) === 'youtube')>
                    Video YouTube
                </option>

                <option value="upload_video"
                    @selected(old('jenis', $materi->jenis) === 'upload_video')>
                    Upload Video dari Komputer
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="foto">Foto Materi / Sampul</label>

            <input type="file"
                   id="foto"
                   name="foto"
                   accept="image/jpeg,image/png,image/webp">

            <small>
                Kosongkan jika tidak ingin mengganti foto. Format JPG,
                PNG, atau WebP. Maksimal 2 MB.
            </small>

            @if ($materi->foto)
                <div class="media-preview">
                    <strong>Foto saat ini</strong>

                    <img
                        src="{{ asset('storage/' . ltrim($materi->foto, '/')) }}"
                        alt="Foto materi {{ $materi->judul }}"
                        onerror="this.style.display='none';">

                    <small>Unggah foto baru jika ingin menggantinya.</small>
                </div>
            @endif
        </div>

        <div id="youtube-fields"
             class="form-group video-fields">
            <label for="video_url">Tautan Video YouTube *</label>

            <input type="url"
                   id="video_url"
                   name="video_url"
                   value="{{ old('video_url', $materi->video_url) }}"
                   placeholder="https://www.youtube.com/watch?v=...">

            <small>
                Masukkan tautan YouTube yang dapat diputar atau disematkan.
            </small>

            @if ($materi->video_url)
                <div class="media-preview">
                    <strong>Tautan YouTube saat ini</strong>
                    <p>
                        <a href="{{ $materi->video_url }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            {{ $materi->video_url }}
                        </a>
                    </p>
                </div>
            @endif
        </div>

        <div id="upload-fields"
             class="form-group video-fields">
            <label for="video_file">File Video</label>

            <input type="file"
                   id="video_file"
                   name="video_file"
                   accept="video/mp4,video/webm,video/quicktime">

            <small>
                Kosongkan jika tidak ingin mengganti video.
                Format MP4, WebM, atau MOV. Maksimal 50 MB.
            </small>

            @if ($materi->video_file)
                <div class="media-preview">
                    <strong>Video yang tersimpan saat ini</strong>
                    <p>
                        <a href="{{ asset('storage/' . ltrim($materi->video_file, '/')) }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            Lihat video saat ini
                        </a>
                    </p>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status Materi *</label>

            <select id="status" name="status" required>
                <option value="draft"
                    @selected(old('status', $materi->status) === 'draft')>
                    Draft
                </option>

                <option value="published"
                    @selected(old('status', $materi->status) === 'published')>
                    Publikasikan
                </option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.materi.index') }}"
               class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    const jenisSelect = document.getElementById('jenis');
    const youtubeFields = document.getElementById('youtube-fields');
    const uploadFields = document.getElementById('upload-fields');
    const youtubeInput = document.getElementById('video_url');
    const uploadInput = document.getElementById('video_file');

    function updateJenisFields() {
        const jenis = jenisSelect.value;

        youtubeFields.classList.toggle('show', jenis === 'youtube');
        uploadFields.classList.toggle('show', jenis === 'upload_video');

        youtubeInput.required = jenis === 'youtube';
        uploadInput.required = jenis === 'upload_video';

        // Hanya mewajibkan unggahan baru jika jenis upload video
        // dan belum ada file video yang tersimpan.
        @if ($materi->video_file)
            uploadInput.required = false;
        @endif
    }

    jenisSelect.addEventListener('change', updateJenisFields);
    updateJenisFields();
</script>
@endsection