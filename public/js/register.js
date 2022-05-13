window.onload = function() {
    var button = document.querySelector("#registerBtn");
     button.addEventListener("click", register);
}

function register () {
    var name = document.querySelector("#name").value;
    var email = document.querySelector("#email").value;
    var password = document.querySelector("#password").value;
    var confirmPass = document.querySelector("#confPass").value;
    var genders = document.getElementsByName("gender");
    var selectedGender = "";

    var reName= /^[A-Z][a-z]{2,15}\s[A-Z][a-z]{2,15}$/;
    var reEmail = /^([A-Za-z0-9\_\-\.])+\@([A-Za-z0-9\_\-\.])+\.([A-Za-z]{2,4})$/;
    var rePassword = /^[a-z0-9]{8,}$/;

    var nameError = document.querySelector("#nameError");
    var emailError = document.querySelector("#emailError");
    var passwordError = document.querySelector("#passwordError");
    var confirmPassError = document.querySelector("#confirmPasswordError");
    var genderError = document.querySelector("#genderError");

    var nameOk = true;
    var emailOk = true;
    var passwordOk = true;
    var confirmPassOk = true;
    var genderChecked = true;

    if (name) {
        if (!reName.test(name)) {
            nameOk = false;
            nameError.textContent = "Ime nije ispravnog formata!";
        }
    } else {
        nameOk = false;
        nameError.textContent = "Polje za ime ne sme biti prazno!";
    }

    if (password) {
        if (!rePassword.test(password)) {
            passwordOk = false;
            passwordError.textContent = "Lozinka nije ispravnog formata ili ima manje od 8 karaktera!";
        }
    } else {
        passwordOk = false;
        passwordError.textContent = "Polje za lozinku ne sme biti prazno!";
    }

    if (email) {
        if (!reEmail.test(email)) {
            emailOk = false;
            emailError.textContent = "Email nije ispravanog formata!";
        }
    } else {
        emailOk = false;
        emailError.textContent = "Polje za email ne sme biti prazno!";
    }

    if (confirmPass !== password) {
        confirmPassOk = false;
        confirmPassError.textContent = "Lozinke se ne poklapaju!";
    }

    for (var i = 0; i < genders.length; i++) {
        if (genders[i].checked) {
            selectedGender = genders[i].value;
            break;
        }
    }

    if (selectedGender === "") {
        genderChecked = false;
        genderError.textContent = "Morate izabrati pol!";
    }

    if (nameOk && emailOk && passwordOk && confirmPassOk && genderChecked) {
        nameError.textContent = "";
        emailError.textContent = "";
        passwordError.textContent = "";
        confirmPassError.textContent = "";
        genderError.textContent = "";

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/do-register",
            method : "POST",
            dataType: "json",
            data: {
                registerBtn : true,
                name, email, password, selectedGender, confirmPass
            },
            success: function (data) {
                console.log(data.success);
                document.querySelector("#name").value = '';
                document.querySelector("#email").value = '';
                document.querySelector("#password").value = '';
                document.querySelector("#confPass").value = '';
                genders.forEach(gender => gender.checked = false);
                var alertDiv = document.querySelector('#successMessage');
                var message = document.querySelector('#msg');

                alertDiv.classList.remove('invisible');
                alertDiv.classList.add('alert-success');
                message.textContent = data.success;
                setTimeout(function () {
                    alertDiv.classList.add('invisible')
                }, 2500);
            },
            error : function (xhr,status, err) {
                console.log(xhr);
                console.log(err);

                var alertDiv = document.querySelector('#successMessage');
                 var message = document.querySelector('#msg');
                 switch (xhr.status) {
                     case 409:
                         alertDiv.classList.remove('invisible');
                         alertDiv.classList.add('alert-warning');
                         message.textContent = 'Konflikt, greška!';
                         break;
                     case 422:
                         alertDiv.classList.remove('invisible');
                         alertDiv.classList.add('alert-warning');
                         message.textContent = 'Email nije dostupan, već je u upotrebi!';
                         console.clear();
                         break;
                 }
            }
        })
    } else {
        console.log("Ima gresaka");
    }
}
