$( document ).ready(function() {
    $("#contact-form").validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            errorPlacement(error, element)
        }
    })

    $.validator.addClassRules('dynamic-input', {
        required: true,
        maxlength: 13,
        duplicateValidator: true,
        phoneNumberValidator: true
    })

    $.validator.messages.required = 'Phone Number cannot be blank.'

    // phone number validator
    let phoneRegex = new RegExp(/^(?:\+38)?(?:0[0-99]{2}[0-9]{3}[0-9]{2}[0-9]{2}|0[0-99]{2}[0-9]{3}[0-9]{2}[0-9]{2}|0[0-99]{2}[0-9]{7})$/);

    let phoneNumberInvalid = function(value) {
        return phoneRegex.test(value);
    }

    $.validator.addMethod("phoneNumberValidator", function(value, element) {
        return phoneNumberInvalid(value);
    }, 'Phone Number is invalid.');

    // phone number duplication validator
    $.validator.addMethod("duplicateValidator", function(value, element) {
        let parentForm = $(element).closest('form');
        let timeRepeated = 0;
        if (value !== '') {
            $(parentForm.find($('.phone-number-input'))).each(function () {
                if ($(this).val() === value) {
                    timeRepeated++;
                }
            });
        }
        return timeRepeated === 1 || timeRepeated === 0;

    }, "* Duplicate");

    function errorPlacement(error, element){
        let container = $('<div />');
        let parent = $('#form-group-' + element.data('index'))
        container.addClass('help-block');
        error.appendTo(parent);
        error.wrap(container);

        (function() {
            $('.error').css({
                'color': '#a94442',
            });
        })();
    }
});