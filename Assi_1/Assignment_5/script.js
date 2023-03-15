$(document).ready(function () {
    $('#myform').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: $('#myform').serialize(),
            success: function (response) {
                $('#mytable tbody').append(response)
                $('#Title').val('');
                $('#Rating').val('');

            },



            error: function (xhr, status, error) {
                alert("failed" + xhr + status + error);
            }
        });
    });
});

