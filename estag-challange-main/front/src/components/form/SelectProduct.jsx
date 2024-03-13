import { useEffect } from 'react'
import axios from 'axios'
import { useState } from 'react'
import style from './SelectProduct.module.css'

function Select({onChange}){

    const [data, setData] = useState([])
    useEffect(()=> {
        axios.get('http://localhost/Desafio1/Script/SelectDropdownProducts.php')
        .then(res => setData(res.data))
        .catch(err => console.log(err))
    }, [])
    return (
        <div>
            <select onChange={onChange} key="SelectProducts" name="SelectProducts" id="SelectProducts" required={true}>
                <option disabled>Chose an option</option>
                {
                data.map(data => (
                    <option value={data.code} key={data.code}>
                        {data.categoriesname}
                    </option>
                ))}
            </select>
        </div>
    )
}
export default Select