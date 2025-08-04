$(document).ready(function () {
    if ($('.role-select option:selected').attr('data-limited') == 1) {
        $('.branch-container').show();
    }

    $(document).on("change", ".role-select", function (e) {
        e.preventDefault();
        if ($(this).find('option:selected').attr('data-limited') == 1) {
            $('.branch-container').show();
        } else {
            $('.branch-container').find('select').val('');
            $('.branch-container').hide();
        }
    });

    $(".see-password").click(function (e) {
        e.preventDefault();

        var that = $(this),
            i = that.find("i");
        parent = that.parents(".input-group"),
            field = parent.find("input[name='password']");

        if (field.length > 0) {
            var field_type = field.attr("type"),
                type = (field_type == "password") ? "text" : "password";

            field.attr("type", type);

            if (i.length > 0) {

                if (field_type == "password") {
                    i.removeClass("fa-eye-slash");
                    i.addClass("fa-eye");
                } else {
                    i.removeClass("fa-eye");
                    i.addClass("fa-eye-slash");
                }

            }
        }
    });
})
