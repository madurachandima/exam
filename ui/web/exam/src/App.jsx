import { useState } from "react";
import "./App.css";
import Login from "./components/Login";
import DashBoard from "./components/DashBorad";

function App() {
  const [token, setToken] = useState("");

  if (!token) {
    console.log("token not found", token);
    return <Login setToken={setToken} />;
  } else {
    return <DashBoard getToken={token} setToken={setToken} />;
  }
}

export default App;
