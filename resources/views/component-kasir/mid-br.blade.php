<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('/css/css-kasir/mid-bar.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>



<body>
    <div class="right-bar">
        <h1>Pembayaran</h1>
        <p>Total</p>
        <form>
            <h1 style="text-align: left; margin-left: 20px">
                {{ number_format(Session::get('subtotal'), 0, ',', '.') }}
            </h1>

            <div class="byr">
                <label for="dibayar">Dibayar : </label>
                <input type="number" name="dibayar" id="dibayar">
            </div><br>

            <button type="button" onclick="calculateChange()">Confirm</button>
        </form>
    </div>




</body>

</html>

{{-- <script>
        function calculateChange() {
            // Get the updated values
            var subtotal = parseFloat("{{ Session::get('subtotal') }}");
            var dibayarValue = parseFloat(document.getElementById("dibayar").value);

            // Apply discount if subtotal is more than 100000
            var diskonValue = 0;
            if (subtotal > 100000) {
                diskonValue = subtotal * 0.05;
            }

            // Calculate subtotal after discount
            var subtotal2Value = subtotal - diskonValue;

            // Calculate kembalian
            var kembalianValue = dibayarValue - subtotal2Value;

            // Display the values in the respective fields
            document.getElementById("diskon").value = diskonValue.toFixed(2);
            document.getElementById("subtotal2").value = subtotal2Value.toFixed(2);
            document.getElementById("kembalian").value = kembalianValue.toFixed(2);

            // Print the receipt
            printF();
        }

        function printF() {
            // Get the updated values
            var dibayarValue = parseFloat(document.getElementById("dibayar").value);
            var diskonValue = parseFloat(document.getElementById("diskon").value);
            var subtotal2Value = parseFloat(document.getElementById("subtotal2").value);
            var kembalianValue = parseFloat(document.getElementById("kembalian").value);

            // Send data to the server using AJAX
            $.ajax({
                url: '/print/dua', // Replace with your correct endpoint
                method: 'POST', // Change to POST if your server endpoint expects POST
                data: {
                    _token: "{{ csrf_token() }}",
                    diskon: diskonValue,
                    dibayar: dibayarValue,
                    subtotal2: subtotal2Value,
                    kembalian: kembalianValue
                },

                success: function(response) {
                    console.log(response); // Log the entire response object for debugging
                    var dataFromServer = response.data;

                    window.location.href = response.redirect + '?data=' + encodeURIComponent(JSON.stringify(
                        dataFromServer));

                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
    </script> --}}
