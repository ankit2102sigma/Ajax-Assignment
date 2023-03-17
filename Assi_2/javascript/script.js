$(document).ready(function() {
    $('#form').submit(function(event) {

        var formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: 'signin.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                if(response){
                    window.location.href = "login.html";
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
        event.preventDefault();
    });
});


$(document).ready(function() {
    $('#tabledata').submit(function(event) {

        var formData = {
            userId: $('#userid').val(),
            title: $('#Post_title').val(),
            description: $('#Post_description').val(),
        };

        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                window.location.href = "view.html";
                $('#mytable tbody').empty()
                var len = response.length
                for (var i = 0; i < len; i++) {
                var id = response[i].id
                var userid = response[i].userId
                var title = response[i].Title
                var description = response[i].description
                var tr_str =
                    '<tr>' +
                    '<td>' + id + '</td>' +
                    '<td>' + userid + '</td>' +
                    '<td>' + title +  '</td>' +
                    '<td>' +  description +  '</td>' +
                    "<td><button  class='deleteBtn' data-id='" + id +"'>Delete</button></td>" +
                    '</tr>'
                    $('#mytable tbody').append(tr_str)
                    $('#title').val('')
                    $('#rating').val('')
                    
                }
                    },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
        event.preventDefault();
    });
});

