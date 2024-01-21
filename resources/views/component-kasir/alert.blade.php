<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/alert.css') }}">
    <title>Alert</title>
</head>

<body>
    {{-- jika delete berhasil dilakukan di cotroler ia akan membuat 
        parameter succsess di session dan dipanggilke sini --}}

    @if (!empty($message_missing))
        <div class="alert alert-missing">
            {{ $message_missing }}
        </div>
    @endif
</body>

</html>
