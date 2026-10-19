
@extends('admin.layout')

@section('title', 'Detail Peserta - Web Pelatihan')

@section('content')
<style>
    .detail-card {
        max-width: 800px;
        padding: 25px;
        background: #fff;
        border: 1px solid #e1eaf4;
        border-radius: 12px;
    }

    .detail-info {
        padding: 15px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .detail-label {
        display: block;
        margin-bottom: 6px;
        color: #68758a;
        font-size: 13px;
    }

    .detail-value {
        color: #294866;
        font-weight: 600;
    }

    .btn-back {
        display: inline-block;
        margin-top: 22px;
        padding: 11px 16px;
        border-radius: 8px;
        background: #327fc7;
        color: #fff;
        text-decoration: none;
    }
</style>

<h1 class="page-title">Detail Peserta</h1>
<p style="color:#687f96; margin:8px 0 22px;">
    Informasi akun peserta pelatihan.
</p>

<div class="detail-card">
    <div class="detail-info">
        <span class="detail-label">ID Peserta</span>
        <span class="detail-value">{{ $peserta->id }}</span>
    </div>

    <div class="detail-info">
        <span class="detail-label">Nama Lengkap</span>
        <span class="detail-value">{{ $peserta->name }}</span>
    </div>

    <div class="detail-info">
        <span class="detail-label">Email</span>
        <span class="detail-value">{{ $peserta->email }}</span>
    </div>

    <div class="detail-info">
        <span class="detail-label">Nomor HP</span>
        <span class="detail-value">{{ $peserta->nomor_hp ?: '-' }}</span>
    </div>

    <div class="detail-info">
        <span class="detail-label">Tanggal Terdaftar</span>
        <span class="detail-value">
            {{ $peserta->created_at?->format('d-m-Y H:i') ?? '-' }}
        </span>
    </div>

    <div class="detail-info">
        <span class="detail-label">Status Email</span>
        <span class="detail-value">
            {{ $peserta->email_verified_at ? 'Terverifikasi' : 'Belum terverifikasi' }}
        </span>
    </div>

    <a href="{{ route('admin.peserta.index') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Daftar Peserta
    </a>
</div>
@endsection
