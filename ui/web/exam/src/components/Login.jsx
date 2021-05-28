import { Button, Link, TextField } from '@material-ui/core'
import React, { useState } from 'react'
import './Login.css';



function Login({ onAdd }) {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');



    const onSubmit = (e) => {
        e.preventDefault()
        if (!username && !password) { alert("please insert username and password"); return; }

        onAdd({ username, password });


        setUsername('');
        setPassword('');
    }


    return (
        <div className="login">
            <div className='register-form'>
                <h2>Login</h2>
                <form onSubmit={onSubmit}>
                    <div className="input-text">
                        <TextField
                            label="User Name"
                            type="text"
                            variant="outlined"
                            id='MuiInputBase-input'
                            value={username}
                            onChange={(e) => setUsername(e.target.value)} />
                    </div>

                    <div className="input-text">
                        <TextField
                            label="Password"
                            type="password"
                            variant="outlined"
                            id='MuiInputBase-input'
                            value={password}
                            onChange={(e) => setPassword(e.target.value)} />
                    </div>

                    <div className='button'>
                        <Button variant="contained" color="primary" type="submit">Login</Button>
                    </div>
                    <div className="link">
                        {/* <Link>Dont have a account</Link>
                <Link>Forget password</Link> */}
                    </div>
                </form>
            </div>

        </div>
    )
}

export default Login
