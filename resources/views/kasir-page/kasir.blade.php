<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

</head>

<body class="bg-secondary" style="font-family: 'Roboto', sans-serif;">
    <div class="bg-white m-3 border px-3 py-3" style="width:633px; height:725px;">
        <h2 style="font-size: 20px">{{ Auth::User()->name }}</h2>
        <div class="src d-flex">
            <input class="border " style="background: #D9D9D9; height:40px; width: 218px; font-size:17px;"
                type="text" placeholder="Cari Barang">
            <a href="" class="btn btn-primary mx-4"
                style="border-radius:0px; height:40px; widtth:98px; font-size:20px; ">Search</a>
        </div>

        <div class="my-4 container" style="background: #D9D9D9; font-size: 20px;">
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Stok</th>
                        <p></p>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
