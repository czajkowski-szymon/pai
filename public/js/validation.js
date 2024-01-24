const form = document.querySelector("form");
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validatePassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

function validateCheckboxes() {
    var form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        var checkboxes = document.querySelectorAll('.sport-input');
        var checked = false;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                checked = true;
            }
        });

        if (!checked) {
            alert('Choose at least one sport.');
            event.preventDefault();
        }
    });
}

document.addEventListener('DOMContentLoaded', validateCheckboxes);
confirmedPasswordInput.addEventListener('keyup', validatePassword);