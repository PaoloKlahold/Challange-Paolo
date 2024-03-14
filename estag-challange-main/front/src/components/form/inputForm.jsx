import { useState } from 'react';
import styles from './input.module.css'

const Input = (props) => {
    const [focused, setFocused] = useState(false);
    const {idDiv, errorMessage, onChange, id, ...inputProps} = props;

    const handleFocus = (e) => {
      setFocused(true);
    };
    return (
      <div id={idDiv} className={styles.input_control}>
        <input 
        {...inputProps}
        id={id} 
        onChange={onChange} 
        onBlur={handleFocus} 
        onFocus={() => 
          inputProps === "confirmPassword" && setFocused(true)}
        focused={focused.toString()
        
        }/>
        <span>{errorMessage}</span>
      </div>
    )
  }

export default Input