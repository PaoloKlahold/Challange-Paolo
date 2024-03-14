import $ from "jquery";
import {useEffect, useState} from "react";
import Input from "../form/inputForm"
import style from "./Register.module.css"


function Register() {

    

    const [values, setValues] = useState({
        FullName: "",
        Email: "",
        password: "",
        confirmpassword: "" 
    });

    const inputs = [{
        id: 'FullName',
        idDiv: "input_control",
        name:"FullName",
        type:"text",
        placeholder:"Full Name",
        errorMessage: "username invalid, should be 1-50 characters and shouldn't include specials characters",
        pattern: "^[A-Za-z0-9]{1,50}$",
        required: true
        },
        {
            id: 'Email',
            idDiv: "input_control",
            name:"Email",
            type:"email",
            placeholder:"your@email.com",
            errorMessage: "invalid email",
            pattern: "^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$",
            required: true
            },
        {
            id: 'password',
            idDiv: "input_control",
            name:"password",
            type:"password",
            placeholder:"password",
            errorMessage: "should be 6-50 characters and shouldn't include specials characters",
            pattern: "^[A-Za-z0-9]{6,50}$",
            required: true
        }, 
        {
            id: 'confirmpassword',
            idDiv: "input_control",
            name:"confirmpassword",
            type:"password",
            placeholder:"confirmpassword",
            errorMessage: "Passwords don't match",
            pattern: values.password,
            required: true
            },

    ]


    const onChange = (e)=>{
        setValues({...values, [e.target.name]: e.target.value})  
    };

  const [result, setResult] = useState("")
  
  const handleSubmit =  async (e) => {
      e.preventDefault();
      setValues({...values, [e.target.name]: e.target.value})
      const form = $(e.target)

      
      async function doAjax(url, args) {
        const result = await $.ajax({
          type: "POST",
          url: url,
          data: args,
        });
        return result;
        }
        const stuff = await doAjax(form.attr("action"),form.serialize())
        setResult(stuff)

        if (stuff != "this email address has already been registered"){
            localStorage.setItem("ActualUser", values.Email);
            window.location.href = "http://localhost:5173/Home"
        }
    };
    

    return (<div className={style.divform}>
        <form className="formregister" action="http://localhost/Desafio1/Script/NewRegister.php" method="post" onSubmit={(event) => handleSubmit(event)}>  
        <h1>Register</h1>
        {inputs.map((input) => (
            <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
        ))}
        <button className={style.ButtonSubmit}>Register</button>
        <a className={style.error}>{result}</a>
        <a className={style.login} onClick="window.location.href = 'http://localhost:5173/Login'" href="http://localhost:5173/Login">Login ↗</a>
    </form></div>
    )

}


export default Register