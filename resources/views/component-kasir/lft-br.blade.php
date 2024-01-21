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
                <input class="search-input" style="" type="text" placeholder="Cari Barang">
                <a href="" class="btn btn-primary">Search</a>
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
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sandal</td>
                            <td>17</td>
                            <td>25000</td>
                            <td><a href="">Select</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laptop</td>
                            <td>7</td>
                            <td>3000000</td>
                            <td><a href="">Select</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>toples</td>
                            <td>20</td>
                            <td>150000</td>
                            <td><a href="">Select</a></td>
                        </tr>
                    </tbody>
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
                                <td>Sandal</td>
                                <td>2</td>
                                <td>50000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-qty">
                    <h3>Tambah Qty Barang</h3>

                    <input class="qty-input" type="number">
                    <a href="">Tambah</a>
                </div>
                <a href="">Confirm</a>
            </div>
        </div>
    </div>
</body>

</html>
