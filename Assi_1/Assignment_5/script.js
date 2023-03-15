{/* <script > */}
$(document).ready(function () {
  $("form").submit(function (event) {
    $('tbody').empty();
    var formData = {
      title: $("#title").val(),
      rating: $("#rating").val(),
    };

    $.ajax({
      type: "POST",
      url: "insert.php",
      data: formData,
      dataType: "json",
      encode: true,
      success: function (response) {
          var len = response.length;
          for(var i=0; i<len; i++){
              var id = response[i].id;
              var title = response[i].Title;
              var rating = response[i].rating;
              var tr_str = "<tr>" +
                  "<td>" + id + "</td>" +
                  "<td>" + title + "</td>" +
                  "<td>" + rating + "</td>" +
                  "</tr>";
              $("#mytable tbody").append(tr_str);
              $('#title').val('');
              $('#rating').val('');
          }
      }
    });

    event.preventDefault();
  });
});
{/* </script> */}