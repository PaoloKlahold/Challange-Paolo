import { useState } from 'react'
import styles from './Table.module.css'
import axios from 'axios'
import { useEffect } from 'react'



function TableProducts() {
    const [data, setData] = useState([])
    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectProducts.php')
        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])
    
    return (
        <div className={styles.DivSuitStoreTable}>
        <div className={styles.SuitStoreTable}>
            <table>
                <thead>
                    <tr className={styles.SuitStoreTableTR}>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th className={styles.ThNoRightBorder}>Category</th>
                        
                    </tr>
                </thead>
                <tbody>
                    {
                        data.map(data => (
                            <tr>
                                <td>{data.code}</td>
                                <td>{data.productsname}</td>
                                <td>{data.price}</td>
                                <td>{data.amount}</td>
                                <td>{data.categoriesname}</td>
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

export default TableProducts