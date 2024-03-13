import styles from "./Home.module.css";
import Input from "../form/inputForm.jsx";
import SubmitButton from "../form/submitButton.jsx";
import {useEffect, useState} from "react";
import axios from 'axios'
import $ from "jquery";
import TableHome from "../form/TableHome.jsx";
import SelectProductHome from "../form/SelectHome.jsx"
import TaxAndTotal from "../others/TaxAndTotal.jsx"
import SubmitAndCancel from "../form/SubmitAndCancel.jsx"




function Home(){
    
    const [values, setValues] = useState({
        Amount: "",
        SelectProducts: ""
        
    });
    
    const inputs = [{
        id: 'Amount',
        idDiv: "input_control",
        name:"Amount",
        type:"text",
        placeholder:"Amount",
        errorMessage:"Amount should be positive and < 9,000 ",
        pattern: "^[A-Za-z0-9]{1,50}$",
        required: true}

    ]

    const [result, setResult] = useState("")
    const handleSubmit = (e) => {
        e.preventDefault();
        data.map((data) => (
        setValues({...values, CategoryTax: data.tax, productPrice: data.price, [e.target.name]: e.target.value})
        ))

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

    const [data, setData] = useState([''])

    const onChange = (e)=>{
          const code = document.getElementById("SelectProducts").value
          axios.get('http://localhost/Desafio1/Script/GetPriceAndTax.php?code=' + code + '&hi')
          .then(res => setData(res.data))
          .catch(err => console.log(err))
  
        data.map((data) => (
        setValues({...values, CategoryTax: data.tax, productPrice: data.price, [e.target.name]: e.target.value})
        ))



        console.log(values)
        
    };
    return (
        
        <div  className={styles.collumns}>
            <div className={styles.collumn1}>
                <form className={styles.Principalform} action="http://localhost/Desafio1/Script/ProcessaHome.php" method="post" onSubmit={(event) => handleSubmit(event)}>
                    <h1>Home</h1>
                    <SelectProductHome key="SelectProducts" id="SelectProducts" value={values["SelectProducts"]}  Name="SelectProducts" onChange={onChange}/>
                    <div className={styles.Subcollum1}>
                    {inputs.map((input) => (
                        <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
                    ))}
                    <div className={styles.input_control}>
                    {data.map(data => ( <input  name="Price" placeholder="Price" value={data.price}/>
                    ))}
                    </div>
                    <div className={styles.input_control}>
                    {data.map(data => ( <input  name="Tax" placeholder="Tax percent" value={data.tax}/>
                    ))}
                    </div>

                    </div>
                    <SubmitButton type="Submit" name="Add to cart" />
                    <a>{result}</a>
                </form>
            </div>
            <div className={styles.collumn2}>
                <div className={styles.subdiv}>
                  <TableHome />
                  <div className={styles.divflutuante}>
                        <TaxAndTotal/>
                        <SubmitAndCancel/>
                  </div>
                </div>
            </div>
        </div>
    )
}
export default Home