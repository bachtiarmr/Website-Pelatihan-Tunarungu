
<div class="table-wrapper">
    <table class="participant-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($peserta as $item)
                {{-- Baris utama peserta --}}
                <tr>
                    <td>{{ $peserta->firstItem() + $loop->index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at?->format('d-m-Y') ?? '-' }}</td>
                    <td>
                        <button
                            type="button"
                            class="btn-detail"
                            data-peserta-id="{{ $item->id }}"
                            aria-expanded="false"
                            aria-controls="detail-peserta-{{ $item->id }}"
                        >
                            <i class="fa-regular fa-eye"></i>
                            Detail
                            <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                        </button>
                    </td>
                </tr>

                {{-- Baris dropdown detail --}}
                <tr
                    id="detail-peserta-{{ $item->id }}"
                    class="detail-row"
                    hidden
                >
                    <td colspan="5">
                        <div class="detail-panel">
                            <h3>
                                <i class="fa-solid fa-user"></i>
                                Informasi Peserta
                            </h3>

                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span>ID Peserta</span>
                                    <strong>{{ $item->id }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Nama Lengkap</span>
                                    <strong>{{ $item->name }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Email</span>
                                    <strong>{{ $item->email }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Nomor HP</span>
                                    <strong>{{ $item->nomor_hp ?: '-' }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Tanggal Terdaftar</span>
                                    <strong>
                                        {{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Status Email</span>
                                    <strong>
                                        @if ($item->email_verified_at)
                                            <span class="status-verified">
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="status-unverified">
                                                Belum terverifikasi
                                            </span>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-message">
                        <i class="fa-solid fa-users"></i>
                        <p>Peserta tidak ditemukan.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($peserta->hasPages())
    <div class="pagination">
        {{ $peserta->links() }}
    </div>
@endif

<style>
    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 13px;
        border: none;
        background: #327fc7;
        color: #fff;
        border-radius: 7px;
        font-family: inherit;
        font-size: 12px;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-detail:hover {
        background: #246bad;
    }

    .dropdown-icon {
        font-size: 10px;
        transition: transform .2s;
    }

    .btn-detail[aria-expanded="true"] .dropdown-icon {
        transform: rotate(180deg);
    }

    .detail-row[hidden] {
        display: none !important;
    }

    .detail-row td {
        padding: 18px !important;
        background: #f3f7fc;
        white-space: normal;
    }

    .detail-panel {
        padding: 20px;
        background: #fff;
        border: 1px solid #dce8f5;
        border-radius: 10px;
    }

    .detail-panel h3 {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0 0 18px;
        color: #294866;
        font-size: 15px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
    }

    .detail-item > span {
        color: #8293a5;
        font-size: 12px;
    }

    .detail-item strong {
        color: #385773;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .status-verified,
    .status-unverified {
        display: inline-block;
        width: fit-content;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
    }

    .status-verified {
        color: #18794e;
        background: #e7f7ee;
    }

    .status-unverified {
        color: #996515;
        background: #fff4d6;
    }

    @media (max-width: 800px) {
        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 500px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-row td {
            padding: 10px !important;
        }

        .detail-panel {
            padding: 14px;
        }
    }
</style>

<script>
(function () {
    // Hindari memasang event listener berulang saat pencarian realtime.
    if (window.pesertaDropdownListenerAttached) return;
    window.pesertaDropdownListenerAttached = true;

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.btn-detail');
        if (!button) return;

        const id = button.dataset.pesertaId;
        const targetRow = document.getElementById('detail-peserta-' + id);

        if (!targetRow) return;

        const shouldOpen = targetRow.hidden;

        // Tutup dropdown lainnya.
        document.querySelectorAll('.detail-row').forEach(function (row) {
            row.hidden = true;
        });

        document.querySelectorAll('.btn-detail').forEach(function (btn) {
            btn.setAttribute('aria-expanded', 'false');
        });

        // Buka dropdown yang dipilih.
        if (shouldOpen) {
            targetRow.hidden = false;
            button.setAttribute('aria-expanded', 'true');
        }
    });
})();
</script>
