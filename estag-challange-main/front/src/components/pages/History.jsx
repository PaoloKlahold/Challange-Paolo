import { useState } from 'react'
import styles from './History.module.css'
import style from '../form/Table.module.css'
import axios from 'axios'
import $ from "jquery"
import { useEffect } from 'react'

function History(){
    if(localStorage.getItem("ActualUser") == '' || localStorage.getItem("ActualUser") == null){
        window.location.href = "http://localhost:5173/"
    }

    const [data, setData] = useState([])

    const code = localStorage.getItem("ActualUser")

    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectHistory.php?code=' + code + '&hi')
        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])



    const [result, setResult] = useState([])
    const handleSubmit = (e) => {
        e.preventDefault();
        
        const form = $(e.target)
        
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success(result) {
                setResult(result);
            },
        });
        console.log(data)
        console.log(result)
    };


    return (
        <div className={styles.collumns}>
            <div className={styles.collumn1}>
                
                
                <div className={styles.subdiv}>

                <div className={style.DivSuitStoreTable}>
                    <div className={style.SuitStoreTable}>
                        <h1>History</h1>
                        <table>
                            <thead>
                                <tr className={style.SuitStoreTableTR}><th>Code</th><th>Total</th><th >Tax</th><th className={style.ThNoRightBorder}>Details</th></tr>
                            </thead>
                            <tbody>
                                {
                                data.map(data => (
                                        <tr>
                                            <td>{data.code}</td>
                                            <td>{data.total}</td>
                                            <td>{data.tax}</td>
                                            
                                            <td><form onSubmit={(event) => handleSubmit(event)} method="POST" action="http://localhost/Desafio1/Script/SelectDetails.php"> <input className={style.invisible} name="code" key={data.code} value={data.code} id={data.code}/> <button type="submit" className={style.ButtonDeleteItem}>View</button></form></td>
                                        </tr>
                                    )
                                )
                                }
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
            </div>
            <div className={styles.collumn2}>
            <div className={style.DivSuitStoreTable}>
            <div className={styles.subdiv}>
                    <div className={style.SuitStoreTable}>
                        <h1>Details</h1>
                        <table>
                            <thead>
                                <tr className={style.SuitStoreTableTR}><th>Product</th><th>Price</th><th>Tax</th><th>Amount</th><th className={style.ThNoRightBorder}>Total</th></tr>
                            </thead>
                            <tbody>
                                {
                                    result.map(result => (
                                        <tr>
                                            <td>{result.productsname}</td>
                                            <td>{result.price}</td>
                                            <td>{result.tax}</td>
                                            <td>{result.amount}</td>
                                            <td>{result.total}</td>
                                        </tr>
                                    )
                                )
                                }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    )
}
export default History