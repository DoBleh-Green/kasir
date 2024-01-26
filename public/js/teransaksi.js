$(document).ready(function() {
    // Prevent default form submission
    $("#searchForm").submit(function(event) {
        event.preventDefault();
        // Your AJAX code for search can go here
    });
});

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