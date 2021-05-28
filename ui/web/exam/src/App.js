import { useState } from 'react';
import './App.css';
import Login from './components/Login';

function App() {
  const [useLogin, setuseLogin] = useState([]);
  const [isLogin, setisLogin] = useState(false);

  const loginDetails = async (data) => {

    const res = await fetch("http://localhost/exam/bizlogic/login", {
      method: 'POST',
      headers: {
        'content-type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(data)
    });

    const resp = await res.json();
    console.log(resp);

    setuseLogin(resp['data']);
    console.log(useLogin);
    { resp['message'] !== "" ? setisLogin(true) : alert("Invalid User namne or password") }
    console.log(isLogin);
  }

  return (
    <div className="App">
      <Login onAdd={loginDetails} />
    </div>
  );
}

export default App;
