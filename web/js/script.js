$( document ).ready(function() {
    let addNumberButton = $('#add-number-button')
    let phoneNumbersContainer = $('#phone-numbers-container')
    let currentAction = getCurrentAction();
    let index = getOperationIndex(currentAction);


    addNumberButton.on('click', function () {
        phoneNumbersContainer.append(appendPhoneNumberField(index))
        index++

        $('.delete-btn').on('click', function () {
            let numberIndex = $(this).data('index')
            deleteNumber(numberIndex);
        });
    })

    $('.delete-btn').on('click', function () {
        let numberIndex = $(this).data('index')
        deleteNumber(numberIndex);
    });

    function appendPhoneNumberField(index){
        return '<div class="form-group" id="form-group-'+ index +'">\n' +
            '\t<label class="control-label" for="phone-number-'+ index +'">Phone number</label>\n' +
            '\t<div class="row">\n' +
            '\t\t<div class="col-sm-11">\n' +
            '\t\t\t<input type="text" id="phone-number-'+ index +'" class="form-control phone-number-input" name="ContactForm[number]['+ index +']" maxlength="13">\n' +
            '\t\t</div>\n' +
            '\t\t<div class="col-sm-1">\n' +
            '\t\t\t<div class="btn btn-danger delete-btn" data-index="'+ index +'">Delete</div>\n' +
            '\t\t</div>\n' +
            '\t</div>\n' +
            '\n' +
            '\t<div class="help-block"></div>\n' +
            '</div>';
    }
    
    function deleteNumber(index){
        $('#form-group-'+ index).remove()
    }

    function getCurrentAction()
    {
        return $('.contact-form').data('current-action')
    }

    function getOperationIndex(currentAction) {
        if (currentAction === 'create') {
            return 1;
        } else {
            return $('.phone-number-input').length
        }
    }
});