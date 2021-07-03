let popupForm = {
    init: function() {
        $(document).on('click', 'header .recall', function() {
            popupForm.open();
            return false;
        });
        $(document).on('click', '.form-block .close', function() {
            popupForm.close();
            return false;
        });


        $('.form-block form').submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = $(this);
            var action = form.attr('action');
            var method = form.attr('method');
            var formData = new FormData(form[0]);

            $.ajax({
                type: method,
                processData: false,
                contentType: false,
                dataType: "json",
                url: action,
                data:  formData,
                success: function(data)
                {
                    if (data.result == 'OK') {
                        if (data.action == 'reload') {
                            document.location = data.url;
                        }
                        else if(data.action == 'alert') {
                            alert(data.message);
                        }
                    }
                    else {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert('Произошла ошибка, попробуйте ещё раз.');
                }
            });


        });
    },

    open: function() {
        $('.form-block').addClass('visible');
    },
    close: function() {
        $('.form-block').removeClass('visible');
    }
};



$(document).ready(function() {
    popupForm.init();
});