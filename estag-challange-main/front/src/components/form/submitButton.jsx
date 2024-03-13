import styles from './SubmitButton.module.css'

function Input({type, idDiv, name, placeholder, handleOnChange}) {
    return (
      <div id={idDiv} className={styles.input_control}>
        <input
          name={name}
          id={name}
          type={type}
          placeholder={placeholder}
          onChange={handleOnChange}
        />
      </div>
    )
  }

export default Input