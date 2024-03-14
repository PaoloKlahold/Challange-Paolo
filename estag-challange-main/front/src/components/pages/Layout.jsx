import { Outlet, Link } from "react-router-dom";
import styles from "./Layout.module.css";
import profile from "./profile.png";



const ClearUser = (e) => {
  e.preventDefault();
  localStorage.setItem("ActualUser", '')
  window.location.href = "http://localhost:5173/"
};



const Layout = () => {
  return (
    <>
      <nav>
        <div className={styles.Itens}>

          <h1><Link to="/Home">Suite Store</Link></h1>
          
          <h2><Link to="/Products">Products</Link></h2>
          
          <h2><Link to="/Categories">Categories</Link></h2>
          
          <h2><Link to="/History">History</Link></h2>
        </div>

        <div className={styles.Part2}>
            <div className={styles.dropdown}>
                <div className={styles.help}>
                    <img className={styles.genericprofile} src={profile} />
                </div>
                <div className={styles.dropdown_content}>
                    <h1 href="#">{localStorage.getItem("ActualUser")}</h1>
                    <a href="#" onClick={(event) => ClearUser(event)}>log out ↗</a>
                    
                </div>
            </div>
        </div>
      </nav>


      <Outlet />
    </>
  )
};

export default Layout;