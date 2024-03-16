function validateRegistrationForm() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirm_password').value;

    if (username.trim() === '') {
        alert('Please enter a username.');
        return false;
    }

    if (password.trim() === '') {
        alert('Please enter a password.');
        return false;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

function validateLoginForm() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    if (username.trim() === '') {
        alert('Please enter your username.');
        return false;
    }

    if (password.trim() === '') {
        alert('Please enter your password.');
        return false;
    }

    return true;
}
