import { Outlet, Link } from "react-router-dom";
import styles from "./Layout.module.css";
import profile from "./profile.png";

const Layout = () => {
  return (
    <>
      <nav>
        <div className={styles.Itens}>
          <h1><Link to="/">Suite Store</Link></h1>
          
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
                    <h1 href="#"></h1>
                    <a href="Script/logout.php">log out ↗</a>
                    
                </div>
            </div>
        </div>
      </nav>


      <Outlet />
    </>
  )
};

export default Layout;