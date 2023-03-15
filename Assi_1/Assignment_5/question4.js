$(document).ready(function(){
    $("#upload-form").submit(function(e){
        e.preventDefault(); // prevent the form from submitting normally

        $.ajax({
            url: "question4.php", // the URL of the PHP file that will handle the file upload(ajax file image upload)
            type: "POST", // the method used for sending the data to the server
            data: new FormData(this),
            processData: false, // tells jQuery not to process the data
            contentType: false, // tells jQuery not to set contentType
            success: function(response){ console.log(response);
                $("#image-preview").attr("src", response); // set the src attribute of the image to the response from the server
            },
           
        });
    });
});