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

        .edit-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .edit-form h1 {
            font-size: 40px;
            color: #000;
            margin-bottom: 20px;
        }


        .edit-form label {
            margin-bottom: 5px;
            text-align: left;
            width: 100%;
            margin-left: 60px;
        }

        .edit-form input {
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

        .edit-btn,
        .close-btn,
        a {
            background-color: #3498DB;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 210px;
            text-decoration: none;
            text-align: center;
        }

        .close-btn {
            background-color: #E55959;
        }
    </style>
</head>

<body>

    <!-- resources/views/form_edit.blade.php -->

    <div id="edit-form" style="display: block;">
        <div class="overlay"></div>
        <div class="form-container">
            <form action="/update/{{ $user->id }}" method="POST" class="edit-form">
                @csrf
                @method('put')
                <h1>Edit Account</h1>
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}">

                <div class="btn-bot">
                    <button class="edit-btn" type="submit">Edit</button>
                    <a class="close-btn" href="{{ route('kasir.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
