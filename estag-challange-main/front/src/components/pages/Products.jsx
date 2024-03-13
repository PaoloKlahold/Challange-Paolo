import styles from "./Products.module.css";
import Input from "../form/inputForm.jsx";
import SubmitButton from "../form/submitButton.jsx";
import {useEffect, useState} from "react";
import $ from "jquery";
import TableProducts from "../form/TableProducts.jsx";
import Selected from "../form/SelectProduct.jsx";

function Products(){
    const [values, setValues] = useState({
        productName:"",
        productPrice:"",
        productAmount:"",
        SelectProducts: ""
    });
    
    const inputs = [{
        id: 'productName',
        idDiv: "input_control",
        name:"productName",
        type:"text",
        placeholder:"Product Name",
        errorMessage:"Product name should be 1-50 characters and shouldn't include specials characters",
        pattern: "^[A-Za-z0-9 ]{1,50}$",
        required: true
        }
    ]
    const inputsCollumn2 = [
    {
        id: 'productPrice',
        idDiv: "input_control",
        name:"productPrice",
        type:"number",
        placeholder:"Price",
        errorMessage:"Price should be positive and < 9,000 ",
        pattern: '/[0-9]+$/',
        min: "1",
        max: "9000",
        required: true
    },
    {
        id: 'productAmount',
        idDiv: "input_control",
        name:"productAmount",
        type:"number",
        placeholder:"Amount",
        errorMessage:"Amount should be positive and < 9,000 ",
        pattern: '/[0-9]+$/',
        min: "1",
        max: "9000",
        required: true
    }
    ]

    const [result, setResult] = useState("")
    const handleSubmit = (e) => {
        e.preventDefault();

        setValues({...values, [e.target.name]: e.target.value})
        console.log(values);


        const form = $(e.target)
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success(data) {
                setResult(data);
            },
        });
        window.location.reload(false);
    };

    const onChange = (e)=>{
        setValues({...values, [e.target.name]: e.target.value})
        
    };
    
    return (
        <div className={styles.collumns}>
            <div className={styles.collumn1}>
                <form className={styles.formProducts} action="http://localhost/Desafio1/Script/ProcessaProducts.php" method="post" onSubmit={(event) => handleSubmit(event)}>
                    <h1>Products</h1>
                    {inputs.map((input) => (
                        <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
                    ))}
                    <div className={styles.Subcollum1}>
                        {inputsCollumn2.map((input) => (
                            <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
                        ))}

                        <Selected key="SelectProducts" id="SelectProducts" value={values["SelectProducts"]}  Name="SelectProducts" onChange={onChange}/>
                        
                    </div>
                    
                    <SubmitButton type="Submit" name="Add Product"/>
                    <a>{result}</a>
                </form>
            </div>
            <div className={styles.collumn2}>
                <div className={styles.subdiv}>
                  <TableProducts />
                  
                </div>
            </div>
        </div>
    )

}
export default Products