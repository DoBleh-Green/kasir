<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/left-bar.css') }}">
</head>

<body>
    <div class="left-bar">
        <div class="a-left-bar">
            <h2>{{ Auth::User()->name }}</h2>
            <div class="g-search">
                <form method="GET" action="{{ route('search') }}">
                    <input class="search-input" type="text" name="query" placeholder="Cari Barang">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="tbl-src">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Stock</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($barang as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>{{ $barang->harga_barang }}</td>
                            <td><a href="#">Select</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="kpb">
                <h2>Konfirmasi Barang</h2>
                <div class="tbl-qty">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-qty">
                    <h3>Tambah Qty Barang</h3>

                    <input class="qty-input" type="number" value="1">
                    <a href="">Tambah</a>
                </div>
                <a href="">Confirm</a>
            </div>
        </div>
    </div>
</body>

</html>
