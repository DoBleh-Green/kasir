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
    <div class="cntr">
        @include('component-kasir.lft-br')
        @include('component-kasir.mid-br')
        @include('component-kasir.right-br')
    </div>
</body>

</html>
