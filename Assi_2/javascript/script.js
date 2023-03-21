$(document).ready(function () {
  $('#form').submit(function (event) {
    var nameRegex = /^[A-Za-z]+$/
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

    // Get form data
    var formData = {
      fname: $('#fname').val(),
      lname: $('#lname').val(),
      email: $('#email').val(),
      password: $('#password').val()
    }

    // Validate input fields
    if (!nameRegex.test(formData.fname)) {
      alert('Please enter a valid first name.')
      return false
    }
    if (!nameRegex.test(formData.lname)) {
      alert('Please enter a valid last name.')
      return false
    }
    if (!passwordRegex.test(formData.password)) {
      alert(
        'Please enter a valid password. Password must contain at least 8 characters, including at least one number, one lowercase letter, and one uppercase letter.'
      )
      return false
    }

    // Send data to server
    $.ajax({
      type: 'POST',
      url: 'signin.php',
      data: formData,
      dataType: 'json',
      encode: true,
      success: function (response) {
        if (response[0]['success']) {
          alert('User registered Sucessfully')
          window.location.href = 'login.html'
        } else {
          alert('Email Already Exist')
          window.location.href = 'index.html'
        }
      },
      error: function (xhr, status, error) {
        console.log('Error:', error)
      }
    })

    // Prevent form submission
    event.preventDefault()
  })
})

$(document).ready(function () {
  $('#update').hide()
  $('#submit').click(function (event) {
    var title = $('#Post_title').val().trim()
    var description = $('#Post_description').val().trim()
    var userId = $('#userid').val().trim()
    if (title === '') {
      alert('Please enter a title')
      return
    }
    if (description === '') {
      alert('Please enter a description')
      return
    }
    if (title.length > 30) {
      alert('Post title must be less than or equal to 30 characters')
      return
    }

    if (description.length > 100) {
      alert('Post description must be less than or equal to 100 characters')
      return
    }
    if (userId.length > 6) {
      alert('User id cannot exceed 6 characters')
      return
    }

    var formData = {
      userId: $('#userid').val(),
      title: $('#Post_title').val(),
      description: $('#Post_description').val()
    }

    $.ajax({
      type: 'POST',
      url: 'insert.php',
      data: formData,
      dataType: 'json',
      encode: true,
      success: function (response) {
        $('#mytable tbody').empty()
        view(response);

          $(document).on('click', '.deleteBtn', function () {
            deleteItem(this);
          })
          $(document).on('click', '.editBtn', function (event) {
            $('#submit').hide()
            $('#update').show()
            editItem(this);
            event.preventDefault()
          })

      },

      error: function (xhr, status, error) {
        console.log('Error:', error)
      }
    })

    event.preventDefault()
  })
})



function deleteItem(element) {
  if (confirm('Are you sure you want to delete this item?')) {
    var id = $(element).data('id')
    var row = $(element).closest('tr')
    $.ajax({
      type: 'POST',
      url: 'delete.php',
      data: { id: id },
      success: function () {
        row.remove()
      }
    })
  }
}

function editItem(element) {

  var id = $(element).data('id')
  var row = $(element).closest('tr')
  var userid = row.find('td:eq(1)').text()
  var title = row.find('td:eq(2)').text()
  var description = row.find('td:eq(3)').text()

  $('#userid').val(userid)
  $('#Post_title').val(title)
  $('#Post_description').val(description)


  $('#update').click(function (event) {
    $('#mytable tbody').empty()
    var updatedformData = {
      id: id,
      userId: $('#userid').val(),
      title: $('#Post_title').val(),
      description: $('#Post_description').val()
    }

    $.ajax({
      type: 'POST',
      url: 'edit.php',
      data: updatedformData,
      dataType: 'json',
      encode: true,
      success: function (response) {
        $('#update').hide()
        $('#submit').show()
        
        view(response);
      },
      


      error: function (xhr, status, error) {
        console.log(xhr, status, error)
      }
    })
    event.preventDefault()
  })
}
// }
function view(element) {
  
  $('#mytable tbody').empty()
  var len = element.length
  for (var i = 0; i < len; i++) {
    var id = element[i].id
    var userid = element[i].user_id
    var title = element[i].Title
    var description = element[i].description
    var tr_str =
      '<tr>' +
      '<td>' +
      id +
      '</td>' +
      '<td>' +
      userid +
      '</td>' +
      '<td>' +
      title +
      '</td>' +
      '<td>' + description +
      '</td>' +
      "<td><button  class='deleteBtn' data-id='" +
      id +
      "'>Delete</button></td>" +
      "<td><button  class='editBtn' data-id='" +
      id +
      "'>Edit</button></td>" +
      '</tr>'
    $('#mytable tbody').append(tr_str)
    $('#userid').val('')
    $('#Post_title').val('')
    $('#Post_description').val('')

  }
}



