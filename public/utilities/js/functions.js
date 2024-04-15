/**
 * These helpers are our own code JS for saving coding time.
 * All functions must ends by Hlper.
 * Version 0.0.2
 */

/**
 * This helper allow to reset all fields in a form
 * @param {string} formId 
 * @param {bool} state 
 */
function cleanAllFieldsHlper(formId, state) {
    $(formId + " input, " + formId + " select, " + formId + " textarea").each(function () {
        const field = $(this); // This is the jquery object of the field, do what you will
        const type = field.attr('type');
        const name = field.attr('name');
        if (type != 'hidden' || (type == 'hidden' && name != 'mode')) {
            if(field.hasClass('no-reset') == false){
                field.val('').prop('disabled', state);
            }
        }
    });
}


/**
 * This helper allow to set all fields in given formId
 * @param {object} data the object to set in given formId fields
 * @param {string} formId id of the form to set
 * @param {bool} state all fields state
 */
function setAllFieldsHlper(data, formId, state) {
    $(formId + " input, " + formId + " select, " + formId + " textarea").each(function () {
        const field = $(this);
        const id = field.attr('id');
        const type = field.attr('type');
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const value = data[key];
                if (key == id) {
                    if (typeof value === 'object' && !(value instanceof Date)) {
                        field.val(value ? value.id : '');
                    }
                    else if (type == 'datetime-local') {
                        field.val(value ? value.slice(0, 16) : '');
                    }
                    else if (type == 'date') {
                        field.val(value ? value.slice(0, 10) : '');
                    }
                    else if (type == 'time') {
                        field.val(value ? value.slice(11, 16) : '');
                    }
                    else if (type != 'file') {
                        field.val(value);
                    }
                    field.prop('disabled', state);
                }
            }
        }
    });
}


/**
 * Pour éviter qu'un formulaire ne soit soumis deux fois de suite par erreur ou lorsque la souris n'est pas en bon état
 * @param {HTMLButtonElement} btn 
 */
function preventFormSubmitTwoTimesHlper(btn) {
    // disable the button
    btn.disabled = true;
    // submit the form    
    btn.form.submit();
}
