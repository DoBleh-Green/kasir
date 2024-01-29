<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/left-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/mid-bar.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="left-bar">
        <div class="a-left-bar">
            <div class="a">
                <a href="/logout" class="btn-logout">Logout</a>

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
                                        <td><button class="add_to_cart" disabled>Barang Habis</button></td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @include('component-kasir.alert')
                </div>

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
                                <th>Total</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                                @php
                                    $totalPrice = 0; // Initialize total price variable
                                @endphp

                                @foreach (Session::get('cart') as $barang_cart)
                                    @php
                                        $subtotal = $barang_cart['harga'] * $barang_cart['quantity'];
                                        $totalPrice += $subtotal; // Add the subtotal to the total price
                                        session()->put('subtotal', $totalPrice);

                                    @endphp
                                    <tr>
                                        <td>{{ $barang_cart['id'] }}</td>
                                        <td>{{ $barang_cart['nama_barang'] }}</td>
                                        <td>{{ number_format($barang_cart['harga'], 0, ',', '.') }}</td>
                                        <td>{{ $barang_cart['quantity'] }}</td>
                                        <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($barang && $barang['stok'] > 0)
                                                <button class="add__qty"
                                                    onclick="addToCart('{{ $barang_cart['id'] }}')">+</button>
                                            @else
                                                <button class="remove__item" disabled>+ </button>
                                            @endif

                                            @if ($barang_cart['quantity'] > 1)
                                                <button class="dec_qty"
                                                    onclick="reduceQuantity('{{ $barang_cart['id'] }}')">-</button>
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
                    <div class="right-bar">
                        <p>Total</p>
                        <form method="POST" action="{{ route('checkout') }}">
                            @csrf
                            <h1 style="text-align: left; margin-left: 20px">
                                {{ number_format(Session::get('subtotal'), 0, ',', '.') }}
                            </h1>

                            <div class="byr">
                                <label for="bayar">Dibayar : </label>
                                <input type="number" name="bayar" id="bayar">
                            </div><br>
                            <button type="submit">Confirm</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="{{ asset('js/teransaksi.js') }}" type="text/javascript"></script>

</body>

</html>
