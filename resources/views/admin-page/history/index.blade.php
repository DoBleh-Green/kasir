<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Barang</title>
</head>
<style>
    body {
        background-color: #2b2b2b;
        font-family: 'Roboto', sans-serif;
    }

    .content {
        margin-left: 320px;
        text-align: center;
    }

    h1 {
        font-size: 35px;
        color: white;
    }

    .container {
        background-color: #d9d9d9;
        margin: 36px;
        padding-bottom: 10px;
        border-radius: 7px;
        padding-top: 20px;
    }

    .container table {
        margin-left: 34px;
        margin-right: 34px;
    }

    .btn {
        justify-content: start;
        text-align: left;
        margin-left: 34px;
    }

    .btn-create {
        background-color: #3498DB;
        width: 107px;
        height: 39px;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .btn-create i {}

    table {
        border-collapse: collapse;
        margin-bottom: 40px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        width: 250px;
        height: 38.61px;
        color: #000;
        text-align: center
    }

    th {
        background-color: #BEBEBE;
        font-size: 25px;
    }

    td {
        background-color: #d5d5d5;
        font-size: 18px;
    }

    i {
        margin-left: 7px;
    }

    .ed {
        display: flex;
        justify-content: space-evenly;
    }

    .btn-edit {
        background-color: #3498DB;
        border-radius: 7px;
        color: #fff;
        text-decoration: none;
        padding: 6px;
    }

    .btn-delete {
        background-color: #E55959;
        border-radius: 7px;
        color: #fff;
        text-decoration: none;
        padding: 8px;
        border: none;
    }
</style>

<body>
    <!-- Memasukkan komponen sidebar menggunakan Blade directive -->
    @include('component.sb')

    <!-- Konten utama halaman -->
    <div class="content">
        <h1>History Pembelian</h1>

        <!-- Container utama -->
        <div class="container">

            <!-- Tombol untuk mencetak riwayat pembelian dalam bentuk PDF -->
            <div class="btn">
                <a href="{{ route('view_pdf') }}" target="_blank" class="btn-create">
                    <i class="fa-solid fa-print" style="margin-right: 11px;"></i>Print
                </a>
            </div><br>

            <!-- Tabel untuk menampilkan riwayat pembelian -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mengambil data riwayat pembelian dari model Struk -->
                    @php
                        $historyPembelian = \App\Models\Struk::all();
                    @endphp

                    <!-- Looping untuk menampilkan setiap data riwayat pembelian -->
                    @foreach ($historyPembelian as $index => $struk)
                        <tr>
                            <!-- Nomor urutan -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Nama kasir -->
                            <td>{{ $struk->nama_kasir }}</td>

                            <!-- Daftar item dalam format JSON -->
                            <td>{{ json_encode($struk->items) }}</td>

                            <!-- Total harga pembelian -->
                            <td>{{ $struk->total_harga }}</td>

                            <!-- Waktu pembelian -->
                            <td>{{ $struk->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
