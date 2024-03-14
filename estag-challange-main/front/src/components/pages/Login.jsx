import $, { map } from "jquery";
import {useEffect, useState} from "react";
import Input from "../form/inputForm"
import style from "./Register.module.css"


function Login() {

    

    const [values, setValues] = useState({
        Email: "",
        password: "",
    });

    const inputs = [
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


      if ((stuff.map((test) => (console.log(test.useremail))))){
        localStorage.setItem("ActualUser", values.Email);
        window.location.href = "http://localhost:5173/Home"
      } else {
        setResult("email or password is incorrect")
      }
  };
  
  

    return (<div className={style.divform}>
        <form className="formregister" action="http://localhost/Desafio1/Script/NewLogin.php" method="post" onSubmit={(event) => handleSubmit(event)}>  
        <h1>Login</h1>
        {inputs.map((input) => (
            <Input key={input.id} {...input} value={values[input.name]} onChange={onChange}/>
        ))}
        <button className={style.ButtonSubmit}>Login</button>

        <a className={style.error}>{result}</a>

        
        <a className={style.login} onClick="window.location.href = 'http://localhost:5173/'" href="http://localhost:5173/">Register ↗</a>
    </form></div>
    )
}


export default Login