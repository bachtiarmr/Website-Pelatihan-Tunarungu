
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263248;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 8px;
        }

        .muted {
            color: #68758a;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000a;
        }

        .search {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d6deea;
            border-radius: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #edf0f5;
        }

        th {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .search {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Data Peserta</h1>
                <p class="muted">Kelola akun peserta pelatihan tunarungu.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="button">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="card">
            <form action="{{ route('admin.peserta.index') }}"
                  method="GET"
                  class="search">
                <input
                    type="text"
                    name="cari"
                    placeholder="Cari nama atau email peserta..."
                    value="{{ request('cari') }}"
                >

                <button type="submit" class="button">Cari</button>
            </form>

            <div class="table-wrapper">
                <table>
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
                                        class="button"
                                    >
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">
                                    Belum ada peserta yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $peserta->links() }}
            </div>
        </div>
    </div>
</body>
</html>
