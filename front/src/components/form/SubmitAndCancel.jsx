import styles from './SubmitAndCancel.module.css'
import { useState } from 'react'
import axios from 'axios'
import { useEffect } from 'react'

function SubmitAndCancel() {


    const [result, setResult] = useState("")
    const handleCancel = (e) => {
        e.preventDefault();

        axios.get('http://localhost/Desafio1/Script/delete.php')
        .then(res => setResult(res.data))
        .catch(err => console.log(err))
        
        
        
        window.location.reload(false);
    };

    const handleFinish = (e) => {
        e.preventDefault();
        const code = localStorage.getItem("ActualUser")
        axios.get('http://localhost/Desafio1/Script/concluido.php?code=' + code + '&hi')
        .then(res => setResult(res.data))
        .catch(err => console.log(err))
        
        
        
        window.location.reload(false);
    };
    

    return (
        <>
        <div className={styles.divButtons}>
            <button onClick={(event) => handleCancel(event)}>Cancel</button>
            <button onClick={(event) => handleFinish(event)}>Finish</button>
        </div>
        <span>{result}</span>
        </>
    )

}

export default SubmitAndCancel