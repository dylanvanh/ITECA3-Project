
//LOGIN PAGE
//input field elements
const form = document.getElementsByName('form')[0];
const email = document.getElementsByName('email')[0];
const password = document.getElementsByName('password')[0];

//changes to false if any errors found
//with input fields
var allChecksPassed;

form.addEventListener('submit', (event) => {
    console.log('test');

    //gets set to false if any validation fails 
    allChecksPassed = true

    //validates the login inputs
    validateInputs();

    //if not all fields valid , prevent form submission
    if (!allChecksPassed) {
        //prevents submission of form
        event.preventDefault();
        //show an alert stating invalid field
        console.log('Invalid details entered');
        alert('Invalid login details entered');
    }

})

const validateInputs = () => {

    //helper function for email validation
    const validateEmail = (email) => {
        let regexPattern = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
        return regexPattern.test(email);
    }

    //email validation
    if (email.value.trim() == "") {
        console.log(email.value);
        //blank email
        allChecksPassed = false;
    } else if (!validateEmail) {
        //invalid email format
        allChecksPassed = false;
    }

    //password validation
    if (password.value.trim() == "") {
        allChecksPassed = false;
    }
}









