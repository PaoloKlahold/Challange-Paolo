import { useState } from 'react'
import styles from './TaxAndTotal.module.css'
import axios from 'axios'
import { useEffect } from 'react'

function TaxAndTotal() {

    const [data, setData] = useState([])
    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectTaxAndTotal.php')

        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])


    return (<div className={styles.DivTaxAndTotal}>
            <div className={styles.nowarp}>
                <h1>Tax: </h1>  {data.map(data => ( 
                    <h1>{data.sumtax}</h1>
                    ))}
            </div>
                <div className={styles.nowarp}>
                <h1>Total: </h1> {data.map(data => ( 
                    <h1>{data.sumtotal}</h1>
                    ))}
            </div>
        </div>
    )  

}

export default TaxAndTotal