@extends('admin.layout')

@section('title', 'Tambah Materi - Web Pelatihan')

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

    .btn-save, .btn-cancel {
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
</style>

<h1 class="page-title">Tambah Materi</h1>
<p class="page-description">
    Isi informasi materi yang akan digunakan dalam pelatihan peserta tunarungu.
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

    <form action="{{ route('admin.materi.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Materi *</label>
            <input type="text"
                   id="judul"
                   name="judul"
                   value="{{ old('judul') }}"
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
                        @selected(old('kategori') === $kategori)>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Materi</label>
            <textarea id="deskripsi"
                      name="deskripsi"
                      placeholder="Jelaskan isi dan tujuan materi...">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis Materi *</label>
            <select id="jenis" name="jenis" required>
                <option value="teks_foto"
                    @selected(old('jenis', 'teks_foto') === 'teks_foto')>
                    Teks dan Foto
                </option>
                <option value="youtube"
                    @selected(old('jenis') === 'youtube')>
                    Video YouTube
                </option>
                <option value="upload_video"
                    @selected(old('jenis') === 'upload_video')>
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
            <small>Format JPG, PNG, atau WebP. Maksimal 2 MB.</small>
        </div>

        <div id="youtube-fields"
             class="form-group video-fields">
            <label for="video_url">Tautan Video YouTube *</label>
            <input type="url"
                   id="video_url"
                   name="video_url"
                   value="{{ old('video_url') }}"
                   placeholder="https://www.youtube.com/watch?v=...">
            <small>
                Gunakan tautan video yang dapat disematkan. Subtitle mengikuti
                ketersediaan subtitle pada video YouTube tersebut.
            </small>
        </div>

        <div id="upload-fields"
             class="form-group video-fields">
            <label for="video_file">File Video *</label>
            <input type="file"
                   id="video_file"
                   name="video_file"
                   accept="video/mp4,video/webm,video/quicktime">
            <small>Format MP4, WebM, atau MOV. Maksimal 50 MB.</small>
            <small>
                Video yang diunggah sendiri belum otomatis memiliki subtitle.
            </small>
        </div>

        <div class="form-group">
            <label for="status">Status Materi *</label>
            <select id="status" name="status" required>
                <option value="draft"
                    @selected(old('status', 'draft') === 'draft')>
                    Draft
                </option>
                <option value="published"
                    @selected(old('status') === 'published')>
                    Publikasikan
                </option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Materi
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
    }

    jenisSelect.addEventListener('change', updateJenisFields);
    updateJenisFields();
</script>
@endsection
