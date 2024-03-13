import styles from "./Categories.module.css";
import Input from "../form/inputForm.jsx";
import SubmitButton from "../form/submitButton.jsx";
import {useRef, useState} from "react";
import $ from "jquery";
import TableCategory from "../form/TableCategories.jsx";



function Categories(){
    
    const [values, setValues] = useState({
        categoryName:"",
        categoryTax:"",
    });
    
    const inputs = [{
        id: 'CategoryName',
        idDiv: "input_control",
        name:"CategoryName",
        type:"text",
        placeholder:"Category Name",
        errorMessage:"Category name should be 1-50 characters and shouldn't include specials characters",
        pattern: "^[A-Za-z0-9]{1,50}$",
        required: true
        },
        {
            id: 'CategoryTax',
            idDiv: "input_control",
            name:"CategoryTax",
            type:"number",
            placeholder:"Tax percent",
            errorMessage:"Tax shouldn't be negative or > 9,000 ",
            pattern: '/[0-9]+$/',
            min: "0",
            max: "9000",
            required: true
        }
    ]

    const [result, setResult] = useState("")
    const handleSubmit = (e) => {
        e.preventDefault();
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
                <form className={styles.formCategories} action="http://localhost/Desafio1/Script/ProcessaCategorias.php" method="post" onSubmit={(event) => handleSubmit(event)}>
                    <h1>Categories</h1>
                    {inputs.map((input) => (
                        <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
                    ))}
                    <SubmitButton type="Submit" name="Add Category" />
                    <a>{result}</a>
                </form>
            </div>
            <div className={styles.collumn2}>
                <div className={styles.subdiv}>
                  <TableCategory />
                </div>
            </div>
        </div>
    )
}
export default Categories