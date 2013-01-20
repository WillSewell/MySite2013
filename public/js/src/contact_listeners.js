function contact_submit_listener() {
    if (!is_valid_email($('#email_text_box').val())) {
        $('#status_div').text('Email not valid');
    } else {
        
        // append to the list of data to send if css doesn't equal 68...
        
        $.ajax({
            type: 'POST',
            url: 'contact/processForm',
            data: {
                from_name: $('#name_text_box').val(),
                from_email: $('#email_text_box').val(),
                msg: $('#msg_text_area').val()
            },
            dataType: 'json',
            success: function() {
                $('#status_div').text('Message sent!');
            },
            error: function() {
                $('#status_div').text('Error sending message!');
            }
        })
    }
} // TODO NEED TO IGNORE IF VALUES ARE DEFAULT!!

function text_box_focus_on(event) {
    console.log($(event.target).css('color'));
    if ($(event.target).css('color') === 'rgb(68, 68, 68)') {
        // it's the default text, delete it
        $(event.target).val('');
        $(event.target).css('color', 'rgb(0, 0, 0) ');
    }
}

function text_box_focus_out(default_text, target) {
    if (target.val() === '') {
        target.val(default_text);
        target.css('color', 'rgb(68, 68, 68)');
    }
}

function is_valid_email(email) {
    return /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/.test(email);
}