function att(){
    console.log('chegou');
    
    console.log('Valor: ' + document.getElementById('dropdownlistProduct').value)
    price = document.getElementById(document.getElementById('dropdownlistProduct').value +'price').value
    tax = document.getElementById(document.getElementById('dropdownlistProduct').value +'tax').value
    $('#TaxInput').val(tax);   
    $('#UnitInput').val(price);
}