import './App.css'
import Home from './components/pages/Home'
import Layout from "./components/pages/Layout"
import Products from "./components/pages/Products"
import Categories from "./components/pages/Categories"
import History from "./components/pages/History"
import { BrowserRouter, Routes, Route } from "react-router-dom"

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index element={<Home />} />
          <Route path="Products" element={<Products />} />
          <Route path="Categories" element={<Categories />} />
          <Route path="History" element={<History />} />
          
        </Route>
      </Routes>
    </BrowserRouter>
  )
}

export default App
