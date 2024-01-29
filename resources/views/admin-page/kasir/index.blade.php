    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Crud Kasir</title>
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

        .btn-create i {
            margin-left: 14.5px;
        }

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
            <h1>Account Kasir</h1>

            <!-- Container utama -->
            <div class="container">

                <!-- Tombol untuk menampilkan/menyembunyikan formulir create kasir -->
                <div class="btn">
                    <a href="javascript:void(0);" onclick="toggleCreateForm()" class="btn-create">Create<i
                            class="fa-solid fa-plus"></i></a>
                </div>

                <!-- Memasukkan komponen formulir create menggunakan Blade directive -->
                @include('component.form_create')

                <!-- Tabel untuk menampilkan data kasir -->
                <table>
                    <!-- Memasukkan komponen alert CRUD menggunakan Blade directive -->
                    @include('component.alert_crud')

                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mengambil data pengguna dengan peran 'kasir' -->
                        @php
                            $kasirUsers = \App\Models\User::where('role', 'kasir')->get();
                        @endphp

                        <!-- Looping untuk menampilkan setiap data kasir -->
                        @foreach ($kasirUsers as $index => $user)
                            <tr>
                                <!-- Nomor urutan -->
                                <td>{{ $index + 1 }}</td>

                                <!-- Nama kasir -->
                                <td>{{ $user->name }}</td>

                                <!-- Email kasir -->
                                <td>{{ $user->email }}</td>

                                <!-- Menyembunyikan password -->
                                <td>Hidden</td>

                                <!-- Tombol aksi edit dan hapus -->
                                <td>
                                    <div class="ed">

                                        <!-- Tombol untuk menuju halaman edit kasir -->
                                        <a class="btn-edit" href="/admin/kasir/form_edit/{{ $user->id }}">Edit <i
                                                class="fa-solid fa-pen"></i></a>

                                        <!-- Form untuk menghapus data kasir -->
                                        <form action="{{ route('kasir.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Tombol untuk mengkonfirmasi penghapusan data -->
                                            <button type="submit" class="btn-delete" style="font-size: 18px;"
                                                onclick="return confirm('Apakah anda Ingin menghapus data ini?')">Delete<i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="{{ asset('js/app1.js') }}" type="text/javascript"></script>
    </body>

    </html>
