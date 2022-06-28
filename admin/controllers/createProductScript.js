
//input field elements
const form = document.getElementsByName('form')[0];
const name = document.getElementsByName('name')[0];
const description = document.getElementsByName('description')[0];
const price = document.getElementsByName('price')[0];

//error elements
const nameErrorElement = document.getElementsByName('name-error')[0];
const descriptionErrorElement = document.getElementsByName('description-error')[0];
const priceErrorElement = document.getElementsByName('price-error')[0];


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
        alert('Invalid Product details entered');
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

    //name validation
    if (name.value.trim() == "") {
        //set the field to "invalidated"
        errorDetected("Name blank", nameErrorElement);
        allChecksPassed = false;
    } else if (validateName(name.value.trim())) {
        allChecksPassed = false;
        errorDetected("Name can't contain numbers", nameErrorElement);
    } else {
        removeErrorText(nameErrorElement);
    }

    //description validation
    if (description.value.trim() == "") {
        //set the field to "invalidated"
        errorDetected("Description blank", descriptionErrorElement);
        allChecksPassed = false;
    } else if (validateName(description.value.trim())) {
        allChecksPassed = false;
        errorDetected("Description can't contain numbers", descriptionErrorElement);
    } else {
        removeErrorText(descriptionErrorElement);
    }

    //price validation
    if (price.value.trim() == "") {
        //set the field to "invalidated"
        errorDetected("Price blank", priceErrorElement);
        allChecksPassed = false;
    } else if (!validateName(price.value.trim())) {
        allChecksPassed = false;
        errorDetected("Price can only contain", priceErrorElement);
    } else {
        removeErrorText(priceErrorElement);
    }
}



