import './App.css'
import Home from './components/pages/Home'
import Layout from "./components/pages/Layout"
import Products from "./components/pages/Products"
import Categories from "./components/pages/Categories"
import History from "./components/pages/History"
import Register from './components/pages/Register'
import Login from './components/pages/Login'
import { BrowserRouter, Routes, Route } from "react-router-dom"

function App() {
  return (
    <BrowserRouter>
      <Routes>
          <Route path="/" element={<Layout />}>
          <Route index element={<Register />} />
          <Route path='Login' element={<Login />} />
          <Route path='Home' element={<Home />} />
          <Route path="Products" element={<Products />} />
          <Route path="Categories" element={<Categories />} />
          <Route path="History" element={<History />} />
          
        </Route>
      </Routes>
    </BrowserRouter>
  )
}

export default App
