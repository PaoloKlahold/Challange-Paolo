const amount = document.getElementById('AmontInput');
const UnitInput = document.getElementById('UnitInput');
const dropdownlistCategory = document.getElementById('dropdownlistCategory');
const ProductNameInput = document.getElementById('ProductNameInput');
const form = document.getElementById('collumn1');
const DivdropdownlistCategory = document.getElementById('DivdropdownlistCategory');



function setError(element, message) {
    
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

};


function setSucess(element) {
   
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
    
};


function setErrorDrop(element, message) {
    const dropdownlistCategory = element;
    const errorDisplay = DivdropdownlistCategory.querySelector('.error')
    errorDisplay.innerText = message;
    
    dropdownlistCategory.classList.add('erro');
    dropdownlistCategory.classList.remove('success');

}
function setSuccessDrop(element) {
    const dropdownlistCategory = element;
    const errorDisplay = DivdropdownlistCategory.querySelector('.error')
    
    errorDisplay.innerText = '';
    dropdownlistCategory.classList.add('success');
    dropdownlistCategory.classList.remove('erro');

}

function validateOnlyUnit(){
    if (document.getElementById('UnitInput').value == '') {
        setError(UnitInput, 'please give a price for the product')

    } else if (document.getElementById('UnitInput').value < 0) {
        setError(UnitInput, 'the price of the product must not be negative')
        
    } else {
        setSucess(UnitInput);
    }
}

function validateOnlydroptable(){
    const dropdownlistCategoryValue = dropdownlistCategory.value.trim();
    
    if (dropdownlistCategoryValue == 'Default'){
        setErrorDrop(dropdownlistCategory, 'please choose a valid alternative')
    } else {
        
        setSuccessDrop(dropdownlistCategory);
    }

}

function validateOnlyAmount(){
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

function validateOnlyProductName(){
    if (document.getElementById('ProductNameInput').value == '') {
        setError(ProductNameInput, 'please give the product a name')
    } else {
        setSucess(ProductNameInput);
    }
}

