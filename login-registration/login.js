const passwordToggle = document.querySelector('.passwordToggle');
const passwordInput = document.querySelector('input[name="passWord"]');
const signUpLink = document.querySelector('.signUpLink')

const usernameId = document.getElementById('username-id')
const passwordId = document.getElementById('password-id')

passwordToggle.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.add('clicked');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('clicked');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const container = document.querySelector(".container");
    container.classList.add("show");

    usernameId.value = ''
    passwordId.value = ''
});

document.addEventListener('DOMContentLoaded', function() {
    var notification = document.querySelector('.notification');
    if (notification) {
        notification.classList.add('show');
        setTimeout(function() {
            notification.classList.remove('show');
        }, 1500); // Adjust the timeout value (in milliseconds) to control how long the notification stays visible
    }
});

/*signUpLink.addEventListener('click', function (event) {
event.preventDefault();
window.open('register.php') // Change 'register.html' to the actual URL of your registration page
});*/