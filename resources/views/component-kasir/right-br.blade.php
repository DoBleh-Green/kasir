<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/css-kasir/srk.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Kasir</title>

</head>

<body class="w-screen h-screen">
    @auth

        <div class="c" id="content">
            <div class="brng-m">
                <h1>Toko Serba</h1>
                <p>Gg.Buntu</p>

                <div class="hdr">
                    @if (isset($struk) && count($struk) > 0)
                        @foreach ($struk as $item)
                            <p style="text-align: left;">{{ $item['id'] }}<br>
                                Oleh: {{ $item['nama_kasir'] }}</p>

                            <p>{{ $item['created_at'] }}</p>
                        @endforeach
                    @else
                        <p>No data available for receipt.</p>
                    @endif
                </div>

                <table style="border-top: 2px solid #000;border-bottom: 2px solid #000;width: 330px;">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalQuantity = 0; // Initialize total quantity variable
                            $subtotalBeforeDiscount = 0; // Initialize subtotal before discount variable
                        @endphp

                        @if (isset($strukItems['items']) && count($strukItems['items']) > 0)
                            @foreach ($strukItems['items'] as $item)
                                @php
                                    $subtotal = $item['harga'] * $item['quantity'];
                                    $subtotalBeforeDiscount += $subtotal; // Add the subtotal to the total price before discount
                                    $totalQuantity += $item['quantity']; // Add the quantity to the total quantity
                                @endphp
                                <tr>
                                    <td>{{ $item['nama_barang'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No items in the receipt.</td>
                            </tr>
                        @endif

                        @php
                            // Apply discount if subtotal is greater than 100000
                            $discountPercentage = $subtotalBeforeDiscount > 100000 ? 0.05 : 0;
                            $discountAmount = $subtotalBeforeDiscount * $discountPercentage;
                            $totalPriceAfterDiscount = $subtotalBeforeDiscount - $discountAmount;

                            // Store the subtotal, discount, and total after discount in the session
                            session()->put('subtotalBeforeDiscount', $subtotalBeforeDiscount);
                            session()->put('discount', $discountAmount);

                            // Retrieve the payment amount from the session
                            $paymentAmount = Session::get('bayar');

                            // Calculate change
                            $change = $paymentAmount - $totalPriceAfterDiscount;
                        @endphp

                    </tbody>
                </table>

                <div class="bott">
                    <div class="bott-1">


                        <div class="d-l">
                            <h4 style="margin: 0;">Total Pembelian</h4>
                            <h4 style="margin: 0;">Total Harga</h4>
                            <h4 style="margin: 0;">Diskon</h4>
                        </div>
                        <div class="d-r">
                            <h4 style="margin: 0;">{{ $totalQuantity }}</h4>
                            <h4 style="margin: 0;"> {{ number_format(session('subtotalBeforeDiscount'), 0, ',', '.') }}
                            </h4>
                            <h4 style="margin: 0;">{{ number_format($discountAmount, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <div class="bott-2">
                        <h4 style="margin: 0;">Total</h4>
                        <h4 style="margin: 0;">{{ number_format($totalPriceAfterDiscount, 0, ',', '.') }}</h4>
                    </div>

                    <div class="bott-2">
                        <h4 style="margin: 0;">Tunai</h4>
                        <h4 style="margin: 0;">{{ number_format(Session::get('bayar'), 0, ',', '.') }}</h4>
                    </div>

                    <div class="bott-2">
                        <h4 style="margin: 0;">Kembalian</h4>
                        <h4 style="margin: 0;">{{ number_format($change, 0, ',', '.') }}</h4>
                    </div>
                    <h4>Barang yang sudah dibeli tidak bisa ditukar/dikembalikan dengan alasan apapun. <br>

                    </h4>
                </div>

            </div>
        </div>
    @endauth
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const invoice = this.document.getElementById("content");
            var contentWidth = invoice.offsetWidth;
            var contentHeight = invoice.offsetHeight;
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'Data.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'tabloid',
                    orientation: 'landscape'
                }
            };
            html2pdf().from(invoice).set(opt).save();
        });
    </script>


</body>

</html>
