<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/left-bar.css') }}">

</head>
<style>
    .right-bar {
        background: #fff;
        width: 370px;
        padding: 20px;
    }

    .right-bar h1 {
        text-align: center;
        margin-top: 0;
    }

    .right-bar p {
        margin-bottom: 0;
    }

    .byr {
        display: flex;
        gap: 30px;
    }

    .kmbl {
        display: flex;
        gap: 9px;
    }

    .discount-container {
        display: flex;
        gap: 35px;
    }
</style>

<body>
    <div class="right-bar">
        <h1>Pembayaran</h1>
        <p>Total</p>
        <h1 style="text-align: left; margin-left: 20px">50000</h1>

        <div class="byr">
            <label for="dibayar">Dibayar : </label>
            <input type="number" value="100000"> <a href="">Confirm</a>
        </div><br>
        <div class="kmbl">
            <label for="kembalian">Kembalian : </label>
            <input type="number" value="50000">
        </div><br>

        <div class="discount-container">
            <label for="discount">Diskon : </label>
            <select id="discount">
                <option value="0">Tidak Ada Diskon</option>
                <option value="5">Diskon 5%</option>
                <option value="10">Diskon 10%</option>
                <option value="15">Diskon 15%</option>
                <!-- Tambahkan opsi diskon sesuai kebutuhan -->
            </select>
            <button onclick="applyDiscount()">Confirm</button>
        </div>
    </div>
</body>

</html>
