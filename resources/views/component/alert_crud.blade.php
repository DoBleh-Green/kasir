<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/alert.css') }}">
    <title>Alert</title>
</head>

<body>
    {{-- jika delete berhasil dilakukan di cotroler ia akan membuat 
        parameter succsess di session dan dipanggilke sini --}}
    @if (session()->has('success-create'))
        @if (session('success-create'))
            <div class="alert alert-success-create">
                {{ session('success-create') }}
            </div>
        @endif
    @endif

    @if (session()->has('success-edit'))
        @if (session('success-edit'))
            <div class="alert alert-info-edit">
                {{ session('success-edit') }}
            </div>
        @endif
    @endif

    @if (session()->has('success-delete'))
        @if (session('success-delete'))
            <div class="alert alert-danger-delete">
                {{ session('success-delete') }}
            </div>
        @endif
    @endif

    @if (!empty($message_missing))
        <div class="alert alert-danger-delete">
            {{ $message_missing }}
        </div>
    @endif
</body>

</html>
