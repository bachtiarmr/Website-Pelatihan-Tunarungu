
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
                <tr>
                    <td>
                        {{ $peserta->firstItem() + $loop->index }}
                    </td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->email }}</td>

                    <td>
                        {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                    </td>

                    <td>
                        <a
                            href="{{ route('admin.peserta.show', $item->id) }}"
                            class="btn-detail"
                        >
                            <i class="fa-regular fa-eye"></i>
                            Detail
                        </a>
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

<div class="pagination">
    {{ $peserta->links() }}
</div>
