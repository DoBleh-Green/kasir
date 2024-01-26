<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/left-bar.css') }}">
</head>
<style>
    .cntr {
        display: flex;
        gap: 20px;
    }
</style>

<body>
    @php
        $dataFromQuery = json_decode(urldecode(request('data')), true);

    @endphp
    <div class="cntr">
        @if (isset($dataFromQuer) && !empty($dataFromQuer))
            @include('component-kasir.lft-br', ['data' => $dataFromQuer, 'barang' => $barang])
            <p>hii</p>
        @else
            @include('component-kasir.lft-br', ['barang' => $barang])
            <p>hi</p>
        @endif
        {{-- @include('component-kasir.mid-br') --}}
        {{-- @include('component-kasir.right-br') --}}
    </div>
</body>

</html>
