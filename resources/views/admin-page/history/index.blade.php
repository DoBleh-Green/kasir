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
    @include('component.sb')
    <div class="content">
        <h1>History Pembelian</h1>

        <div class="container">
            <div class="btn">
                <a href="{{ route('view_pdf') }}" target="blank" class="btn-create"><i class="fa-solid fa-print"
                        style="margin-right: 11px;"></i>Print</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Mengambil data pengguna dengan peran 'kasir'
                        $kasirUsers = \App\Models\User::where('role', 'kasir')->get();
                    @endphp

                    @foreach ($kasirUsers as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>Hidden</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
