
function setError (element, message) {

    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

};


function setSucess (element) {

    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
    
};

function validateOnlyName(){
    const NameInput = document.getElementById('NameInput');
    const NameInputValue = NameInput.value.trim();

    if(NameInputValue == '' || NameInputValue == null){
        setError(NameInput, 'Name is required');
    } else  {
        setSucess(NameInput);
    }
}

function validateOnlypassword(){
    const password = document.getElementById('password');
    const passwordValue = password.value.trim();

    if(passwordValue == '' || passwordValue == null){
        setError(password, 'Password is required');
    } else if (passwordValue.length < 8) {
        setError(password, 'your password must have at least 8 digits');
    } else{
        setSucess(password);
    }
}

function validateOnlyemail(){
    const email = document.getElementById('email');
    const emailValue = email.value.trim();
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if(emailValue == '' || emailValue == null){
        setError(email, 'Invalid email address!');
    } else if (emailValue.match(validRegex)) {
        setSucess(email);
    } else {
      setError(email, 'Invalid email address!');
    }
}

function validateOnlydate(){
    const dateofbirth = document.getElementById('dateofbirth');
    const dateofbirthValue = dateofbirth.value.trim();
    console.log(dateofbirthValue)

    if(dateofbirthValue == '' || dateofbirthValue == null){
        setError(dateofbirth, 'Date of birday is required');
    } else{
        setSucess(dateofbirth);
    }
}


