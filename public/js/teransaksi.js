$(document).ready(function() {
    // Mencegah pengiriman formulir secara default
    $("#searchForm").submit(function(event) {
        event.preventDefault();
        // Kode AJAX untuk pencarian dapat ditempatkan di sini
    });
});

// Fungsi untuk menambahkan barang ke keranjang menggunakan AJAX
function addToCart(id) {
    $.ajax({
        url: "/kasir/" + id,
        type: "POST",
        data: {
            "_token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(data) {
            location.reload();
        },
        error: function(error) {
            console.error("Error adding to cart:", error.responseText);
            alert("Error: Something went wrong. This Page will Refresh.");
            location.reload();
        }
    });
}

// Fungsi untuk menghapus barang dari keranjang menggunakan AJAX
function removeFromCart(id) {
    $.ajax({
        url: "/kasir/" + id + "/remove",
        type: "DELETE",
        data: {
            "_token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(data) {
            location.reload();
        },
        error: function(error) {
            location.reload();
        }
    });
}

// Fungsi untuk mengurangi jumlah barang dalam keranjang menggunakan AJAX
function reduceQuantity(id) {
    $.ajax({
        url: "/kasir/" + id + "/reduce",
        type: "DELETE",
        data: {
            "_token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(data) {
            location.reload();
        },
        error: function(error) {
            location.reload();
        }
    });
}