
//input field elements
const form = document.getElementsByName('form')[0];
const email = document.getElementsByName('email')[0];
const password = document.getElementsByName('password')[0];

//error elements
const emailErrorElement = document.getElementsByName('email-error')[0];
const passwordErrorElement = document.getElementsByName('password-error')[0];


//changes to false if any errors found
//with input fields
var allChecksPassed;

form.addEventListener('submit', (event) => {

    //gets set to false if any validation fails 
    allChecksPassed = true

    //validates the login inputs
    validateInputs();

    //if not all fields valid , prevent form submission
    if (!allChecksPassed) {
        //prevents submission of form
        event.preventDefault();
        //show an alert stating invalid field
        alert('Invalid login details entered');
    }

})

const errorDetected = (errorMessage, element) => {
    console.log(errorMessage, element);
    element.innerText = errorMessage;
}

const removeErrorText = (element) => {
    element.innerText = '';
}

//validates name , by checking for numbers
const validateName = (name) => {
    let regexPattern = new RegExp('[0-9]');
    return regexPattern.test(name);
}

//validates email using regex
const validateEmail = (email) => {
    let regexPattern = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    return regexPattern.test(email);
}

const validateInputs = () => {

    //email validation
    if (email.value.trim() == "") {
        errorDetected("Email blank", emailErrorElement);
        allChecksPassed = false;
    } else if (!validateEmail(email.value.trim())) {
        allChecksPassed = false;
        errorDetected('Email invalid', emailErrorElement);
    } else {
        removeErrorText(emailErrorElement);
    }

    //password validation
    if (password.value.trim() == "") {
        //set the field to "invalidated"
        errorDetected("Password blank", passwordErrorElement);
        allChecksPassed = false;
    } else {
        removeErrorText(passwordErrorElement);
    }
}



