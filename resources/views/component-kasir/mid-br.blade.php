<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
</head>
<style>
    .brng-m {
        background: #fff;
        text-align: center;
        width: 345px;
    }
</style>

<body>
    {{-- @include('component-kasir.lft-br') --}}
    <div class="brng-m">
        <h1>Barang Masuk</h1>

        <table style="border-top: 2px solid #000;">
            <thead style="">
                <tr>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sandal</td>
                    <td>2</td>
                    <td>25000</td>
                    <td>50000</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
