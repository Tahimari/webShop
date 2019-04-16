$(document).ready(function () {
    $('#add-to-cart').on('click', function (e) {
        e.preventDefault();
        
        var link = $(e.currentTarget);

        $.ajax({
            method: 'POST',
            url: link.attr('href')
        }).done(function (data) {
            $('.cart-paragraph').html(data.length);
        })
    });
});
