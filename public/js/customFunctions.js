/**
 * Created by Alejandro on 11/10/2018.
 */

// Hiddding the user form



$(document).on("keyup", '#description', function(){
    var description = $("#description");
    var max = 300;
    if (description.val().length > max) {
        description.val(description.val().substr(0, max));
        $.toaster({
            message: "Maximun amount of characters for description is 300",
            title: 'Message',
            priority: 'warning',
            settings: {'timeout': 2000}
        });
    }
});
// Initalizing the Counter
counterN();

// Function of the counter
function counterN() {
    $('.counter').each(function () {
        var $this = $(this),
            countTo = $this.attr('data-count');
        $({countNum: $this.text()}).animate({
                countNum: countTo
            },
            {
                duration: 1000,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                    $this.text(this.countNum);
                }
            });
    });
}
// Success and Danger button function
function changeButtonNewUser(value) {
    var btn = $('#newUser');
    if (value == 1) {
        btn.text('Cancel new user');
        btn.addClass("btn-danger");
        btn.removeClass("btn-success");
        btn.attr('data-toggle', 0);
    } else {
        btn.text('Add new user');
        btn.removeClass("btn-danger");
        btn.addClass("btn-success");
        btn.attr('data-toggle', 1);
    }
}

function checkMaxLength (text, max) {
}


// Display when uploading the image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file')
                .attr('src', e.target.result)
                .css('maxWidth', '320px')
                .css('maxHeight', '320px');
        };

        reader.readAsDataURL(input.files[0]);
    }
}
