<script>
    $("#newUser").on('click', function () {
        $("#nameform").text("Create new user");
        $("#file").attr("src","{{asset('img/no-image.jpg')}}");
        $("#description").val("");
        $("#newUserdiv").toggle('slow');
        $('#id_user').val("");
        changeButtonNewUser($(this).attr('data-toggle'));
    });

    $(document).on('click', ".edit", function (e) {
        $("#nameform").text("Edit User");
        var id = $(this).attr('data-selector');
        $.ajax('{{url('users/edit')}}', {
            method: "POST",
            data: {"id": id},
            success: function (response) {
                if ($("#newUser").attr('data-toggle') == 1) {
                    $("#newUserdiv").toggle('slow');
                    changeButtonNewUser(1);
                }
                $('#description').val(response.description);
                $('#file').attr('src', "{{asset("img/")}}/"+response.photo);
                $('#id_user').val(id);
            },
            error: function () {
            },
        });
    });

    $(document).on('click','.delete', function (e) {
        var id = $(this).attr('data-selector');
        $.ajax('{{url('users/delete')}}', {
            method: "POST",
            data: {"id": id},
            success: function (response) {
                $('#boardOfUsers').empty();
                $('#boardOfUsers').append(response);
                var num = $("#boardOfUsers").find(".board-item").length;
                $('.counter').attr('data-count', num);
                counterN();
            },
            error: function () {
            },
        });
    });

    $("#formNewUser").submit(function (e) {
        var formData = new FormData($(this)[0]);
        var id_user = $("#id_user").val();
        var _url = "";
        var msg = "";
        var error = "";
        if(id_user == ""){
            _url = "{{url('users/store')}}";
            msg  = "The new user have been saved successfuly"
            error = "Could not save the user, check the description and image and try again.";
        }else{
            _url = "{{url('users/update')}}";
            msg  = "The new user have been updated successfuly"
            error = "Could not update the user, check the description and image and try again.";
        }

        $.ajax({
            url: _url,
            type: "POST",
            data: formData,
            success: function (response) {
                $.toaster({
                    message: msg,
                    title: 'Message',
                    priority: 'success',
                    settings: {'timeout': 2000}
                });
                $('#boardOfUsers').empty();
                $('#boardOfUsers').append(response);
                changeButtonNewUser(0);
                var num = $("#boardOfUsers").find(".board-item").length;
                $('.counter').attr('data-count', num);
                counterN();
            }, error: function () {
                $.toaster({
                    message: error,
                    title: 'Message',
                    priority: 'danger',
                    settings: {'timeout': 2000}
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
        $("#newUserdiv").toggle('slow');

    });
</script>