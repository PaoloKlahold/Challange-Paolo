import { useState } from 'react'
import styles from './Table.module.css'
import axios from 'axios'
import { useEffect } from 'react'



function TableCategory() {
    const [data, setData] = useState([])
    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectCategorias.php')
        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])
    
    return (
        <div className={styles.DivSuitStoreTable}>
        <div className={styles.SuitStoreTable}>
            <table>
                <thead>
                    <tr className={styles.SuitStoreTableTR}><th>Code</th><th className={styles.nameProductTH}>Name</th><th className={styles.ThNoRightBorder}>Tax</th></tr>
                </thead>
                <tbody>
                    {
                        data.map(data => (
                            <tr>
                                <td>{data.code}</td>
                                <td>{data.categoriesname}</td>
                                <td>{data.tax}</td>
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