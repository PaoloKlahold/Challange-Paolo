
const form = document.getElementById('collumn1');
const dropdownlistProduct = document.getElementById('dropdownlistProduct');
const DivDropdownlistProduct = document.getElementById('DivDropdownlistProduct');





function setError (element, message) {

    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

};

function setErrorDrop (element, message) {
    const dropdownlistProduct = element;
    const errorDisplay = DivDropdownlistProduct.querySelector('.error')
    errorDisplay.innerText = message;
    
    dropdownlistProduct.classList.add('erro');
    dropdownlistProduct.classList.remove('success');

}
function setSuccessDrop (element) {
    const dropdownlistProduct = element;
    const errorDisplay = DivDropdownlistProduct.querySelector('.error')
    
    errorDisplay.innerText = '';
    dropdownlistProduct.classList.add('success');
    dropdownlistProduct.classList.remove('erro');

}


function setSucess (element) {

    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
    
};

function validateInputs() {

    const amountValue = amount.value.trim();
    const dropdownlistProductValue = dropdownlistProduct.value.trim();
    
    if(amountValue == '' || amountValue == null){
        setError(amount, 'amount is required');
    } else if (amountValue < 1) {
        setError(amount, 'number of itens cannot be less than 1');
    } else if ((amountValue % 1) != 0) {

        setError(amount, 'number of itens must be integer');
    }else {

        setSucess(amount);
    }
    if (dropdownlistProductValue == 'Default'){
        setErrorDrop(dropdownlistProduct, 'please choose a valid alternative in "products"')
    } else {

        setSuccessDrop(dropdownlistProduct);
    }


};

function validateOnlyAmount(){
    const amount = document.getElementById('AmontInput');
    const amountValue = amount.value.trim();

    if(amountValue == '' || amountValue == null){
        setError(amount, 'amount is required');
    } else if (amountValue < 1) {
        setError(amount, 'number of itens cannot be less than 1');
    } else if ((amountValue % 1) != 0) {
        setError(amount, 'number of itens must be integer');
    }else {
        setSucess(amount);
    }
}


function validateOnlyName(){
    const dropdownlistProductValue = dropdownlistProduct.value.trim();
    
    if (dropdownlistProductValue == 'Default'){
        setErrorDrop(dropdownlistProduct, 'please choose a valid alternative')
    } else {
        
        setSuccessDrop(dropdownlistProduct);
    }

}

