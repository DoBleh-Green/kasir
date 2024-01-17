<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #d9d9d9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-width: 90%;
            z-index: 1001;
            backdrop-filter: blur(5px);
        }

        .create-form-barang {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .create-form-barang h1 {
            font-size: 40px;
            color: #000;
            margin-bottom: 20px;
        }

        .create-form-barang label {
            margin-bottom: 5px;
            text-align: left;
            width: 100%;
            margin-left: 60px;
        }

        .create-form-barang input {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 425px;
            height: 25px;
            font-size: 20px;
        }

        .btn-bot {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            width: 100%;
            margin-top: 20px;
        }

        .create-btn,
        .close-btn {
            background-color: #3498DB;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 210px;
            height: 50px;
        }

        .close-btn {
            background-color: #E55959;
        }
    </style>
</head>

<body>

    <!-- resources/views/form_create.blade.php -->

    <div id="create-form-barang" style="display: none;">
        <div class="overlay"></div>
        <div class="form-container">
            <form action="{{ route('barang.store') }}" method="POST" class="create-form-barang">
                @csrf
                @method('post')
                <h1>Create Barang</h1>
                <label for="name">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" required>

                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" required>

                <label for="harga">Harga:</label>
                <input type="number" id="harga_barang" name="harga_barang" required>

                <div class="btn-bot">
                    <button class="create-btn" type="submit">Create</button>
                    <button class="close-btn" onclick="toggleCreateFormBarang()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</body>

</html>
