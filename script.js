const passwordInput = document.getElementById("check_password_password");
const strengthBar = document.getElementById("check_password_strength-bar");
const check_password_messages = document.getElementById("check_password_messages");
const password_status = document.getElementById("check_password_status");
const toggleIcon = document.getElementById("check_password_toggle-icon");
const requirements = {
    length: document.getElementById("check_password_length"),
    uppercase: document.getElementById("check_password_uppercase"),
    number: document.getElementById("check_password_number"),
    special: document.getElementById("check_password_special")
};

function togglePasswordVisibility() {
    const type = passwordInput.type === "password" ? "text" : "password";
    passwordInput.type = type;
    toggleIcon.classList.toggle("fa-eye");
    toggleIcon.classList.toggle("fa-eye-slash");
}

function checkPasswordStrength() {

    const password = passwordInput.value;
    if(password?.length==0){
        password_status.innerHTML='Le champ est réquis';
        password_status.style.color='red';

        return;

    }
    let strength = 0;

    // Vérifier les exigences
    if (password.length >= 8) {
        updateRequirement(requirements.length, true);
        strength += 25;
    } else {
        updateRequirement(requirements.length, false);
    }

    if (/[A-Z]/.test(password)) {
        updateRequirement(requirements.uppercase, true);
        strength += 25;
    } else {
        updateRequirement(requirements.uppercase, false);
    }

    if (/\d/.test(password)) {
        updateRequirement(requirements.number, true);
        strength += 25;
    } else {
        updateRequirement(requirements.number, false);
    }

    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        updateRequirement(requirements.special, true);
        strength += 25;
    } else {
        updateRequirement(requirements.special, false);
    }

    // Mettre à jour la barre de force
    strengthBar.style.width = `${strength}%`;

    if (strength === 100) {
        strengthBar.style.backgroundColor = "green";
        password_status.style.color='green'
        password_status.innerHTML='Mot de passe fort'
    } else if (strength >= 50) {
        strengthBar.style.backgroundColor = "orange";
        password_status.style.color='orange';
        password_status.innerHTML='Mot de passe un peu complexe';
    } else {
        strengthBar.style.backgroundColor = "red";
        password_status.style.color='red';
        password_status.innerHTML='Mot de passe mauvais';
    }

    check_password_messages.classList.remove('check_password_hidden')
}



function updateRequirement(element, isValid) {
    const icon = element.querySelector('i');
    if (isValid) {
        element.classList.add("valid");
        icon.classList.remove("fa-times");
        icon.classList.add("fa-check");
    } else {
        element.classList.remove("valid");
        icon.classList.remove("fa-check");
        icon.classList.add("fa-times");
    }
}




document.getElementById('check_password_form').addEventListener('submit',(e)=>{
    e.preventDefault();
    checkPasswordStrength();

});