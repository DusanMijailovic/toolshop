

function login() {
    var email = document.querySelector('#email').value;
    var password = document.querySelector('#password').value;

    var passwordError = document.querySelector('#passwordError');
    var emailError = document.querySelector('#emailError');


    var reEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var rePassword = /^[a-z0-9]{8,}$/;

    var emailTrue = true;
    var passwordTrue = true;


    if (email) {
        if (!reEmail.test(email)) {
            emailError.textContent = 'Email nije ispravan!';
            emailTrue = false;
        }
    } else {
        emailError.textContent = 'Polje za email ne sme biti prazno!';
        emailTrue = false;
    }


    if (password) {
        if (!rePassword.test(password)) {
            passwordError.textContent = 'Lozinka nije ispravna!';
            passwordTrue = false;
        }
    } else {
        passwordError.textContent = 'Polje za lozinku ne sme biti prazno!';
        passwordTrue = false;
    }


    if (emailTrue && passwordTrue) {
        return true;
    } else {
        return false;
    }

}
