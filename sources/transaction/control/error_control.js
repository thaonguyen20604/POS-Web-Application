function show_error(error) {
    var errorbox = document.querySelector('.error-container');
    var errormessage = errorbox.querySelector('.error-message');

    errorbox.style.display = 'block';
    errormessage.innerHTML = error;

    setTimeout(function() {
        errorbox.style.opacity = 0;
        setTimeout(function() {
            errormessage.innerHTML = "";
            errorbox.style.display = "none";
            errorbox.style.opacity = 1;
        }, 700);
    }, 1000);
}

function show_success(success) {
    var successbox = document.querySelector('.success-container');
    var successmessage = successbox.querySelector('.success-message');

    successbox.style.display = 'block';
    successmessage.innerHTML = success;

    setTimeout(function() {
        successbox.style.opacity = 0;
        setTimeout(function() {
            successmessage.innerHTML = "";
            successbox.style.display = "none";
            successbox.style.opacity = 1;
        }, 700);
    }, 1000);
}

function disable_button(button_name){
    button = document.getElementById(button_name);

    button.disabled = true;
    button.style.cursor = "not-allowed";
}

function enable_button(button_name){
    button = document.getElementById(button_name);

    button.disabled = false;
    button.style.cursor = "pointer";
}

