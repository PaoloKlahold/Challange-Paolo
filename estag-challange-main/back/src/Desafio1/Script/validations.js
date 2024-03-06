

function setError(element, message){
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

};


function setSucess (element){
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
    
};

function validateInputs(){
    const CategoryName = document.getElementById('CategoryName');
    const form = document.getElementById('collumn1');
    const CategoryTax = document.getElementById('CategoryTax');
    const CategoryNameValue = CategoryName.value.trim();
    const CategoryTaxValue = CategoryTax.value.trim();

    if (CategoryNameValue == ''){
        setError(CategoryName, 'please give the category a name');
    } else {
        setSucess(CategoryName);
    }
    if (CategoryTaxValue == '') {
        setError(CategoryTax, 'please give a tax number for your product');
    }else if (CategoryTaxValue < 0){
        setError(CategoryTax, 'the product tax must not be negative');
    }else {
        setSucess(CategoryTax);
    }

    
};

function validateOnlyName(){
    const CategoryName = document.getElementById('CategoryName');
    const CategoryNameValue = CategoryName.value.trim();
    if (CategoryNameValue == ''){
        setError(CategoryName, 'please give the category a name');
    } else {
        setSucess(CategoryName);
    }
     
}

function validateOnlyTax(){
    const CategoryTax = document.getElementById('CategoryTax');
    const CategoryTaxValue = CategoryTax.value.trim();
    if (CategoryTaxValue == '') {
        setError(CategoryTax, 'please give a tax number for your product');
    }else if (CategoryTaxValue < 0){
        setError(CategoryTax, 'the product tax must not be negative');
    }else {
        setSucess(CategoryTax);
    }
     
}

