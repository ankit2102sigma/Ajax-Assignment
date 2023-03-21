$(document).ready(function () {
  $('#login').submit(function (event) {

    var formloginData = {
      email: $('#username').val(),
      password: $('#password').val()
    }

    $.ajax({
      type: 'POST',
      url: 'php/login.php',
      data: formloginData,
      dataType: 'json',
      encode: true,
      success: function (response) {
        if (response[0]['success']) {
          window.location.href = 'form.html'
        } else {
          alert(response[0]['message'])
        }
      },
      error: function (xhr, status, error) {
        console.log('Error:', error)
      }
    })
    event.preventDefault()
  })
})
