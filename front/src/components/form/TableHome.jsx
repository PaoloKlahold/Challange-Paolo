import { useState } from 'react'
import styles from './Table.module.css'
import axios from 'axios'
import { useEffect } from 'react'



function TableCategory() {
    const [data, setData] = useState([])
    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectHome.php')

        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])

    const [result, setResult] = useState("")
    const handleSubmit = (e) => {
        e.preventDefault();

        const form = $(e.target)
        console.log(form)
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
    
    return (
        <div className={styles.DivSuitStoreTable}>
        <div className={styles.SuitStoreTable}>
            <table>
                <thead>
                    <tr className={styles.SuitStoreTableTR}><th>Product</th><th>Price</th><th>Amount</th><th>Tax</th><th><div className={styles.nowarp}> <a>Total</a> <h3 className={styles.mini}>(Price * Amount + Tax)</h3></div></th><th className={styles.ThNoRightBorder}>Del</th></tr>
                </thead>
                <tbody>
                    {
                        data.map(data => (
                            <tr>
                                <td>{data.productsname}</td>
                                <td>${data.price}</td>
                                <td>{data.hamount}</td>
                                <td>{data.tax}%</td>
                                <td>${data.htotal}</td>
                                <td><form onSubmit={(event) => handleSubmit(event)} method="POST" action="http://localhost/Desafio1/Script/deletethis.php"> <input className={styles.invisible} name="delete" value={data.homeid} id={data.homeid}/> <button type="submit" class={styles.ButtonDeleteItem}>Delete</button></form></td>
                            </tr>
                        )
                    )
                    }
                </tbody>
            </table>
        </div>
    </div>
    )
}

export default TableCategory