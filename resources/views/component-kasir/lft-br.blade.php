<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/left-bar.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="left-bar">
        <div class="a-left-bar">
            <h2>{{ Auth::User()->name }}</h2>
            <form method="GET" action="{{ route('search') }}" class="g-search">
                <input class="search-input" type="text" name="query" placeholder="Cari Barang">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <div class="tbl-src">
                <table id="mainTable">
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
                        @foreach ($barang as $barang)
                            <tr>
                                <td>{{ $barang->id }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->stok }}</td>
                                <td>{{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                                @if ($barang['stok'] > 0)
                                    <td><button class="add_to_cart"
                                            onclick="addToCart('{{ $barang['id'] }}')">Select</button></td>
                                @else
                                    <td><button class="add_to_cart" disabled>Out of Stock</button></td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @include('component-kasir.alert')

            </div>
            <div class="kpb">
                <h2>Konfirmasi Barang</h2>
                <div class="tbl-qty">
                    <table class="item__card" id="sementaraTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                                @foreach (Session::get('cart') as $barang_cart)
                                    <tr>
                                        <td>{{ $barang_cart['id'] }}</td>
                                        <td>{{ $barang_cart['nama_barang'] }}</td>
                                        <td>{{ $barang_cart['harga'] }}</td>
                                        <td>{{ $barang_cart['quantity'] }}</td>
                                        <td> <button class="add__qty"
                                                onclick="updateQuantity('{{ $barang_cart['id'] }}', 1)">+</button>

                                            @if ($barang_cart['quantity'] > 1)
                                                <button class="dec_qty"
                                                    onclick="updateQuantity('{{ $barang_cart['id'] }}', -1)">-</button>
                                            @else
                                                <button class="dec_qty" disabled>-</button>
                                            @endif

                                            <button class="remove__item"
                                                onclick="removeFromCart('{{ $barang_cart['id'] }}')">HApus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>tambahkan barang dulu...</p>
                            @endif
                        </tbody>
                    </table>
                </div>
                <br>
                <a href="">Confirm</a>
            </div>
        </div>
    </div>

    <script>
        function addToCart(id) {
            $.ajax({
                url: "/kasir/" + id,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    location.reload();
                },
                error: function(error) {
                    console.error("Error adding to cart:", error.responseText);
                    alert("Error: Something went wrong. Please try again.");
                }
            });
        }

        function removeFromCart(id) {
            $.ajax({
                url: "/kasir/" + id + "/remove",
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    location.reload();
                },
                error: function(error) {
                    location.reload();
                }
            });
        }
    </script>

</body>

</html>
