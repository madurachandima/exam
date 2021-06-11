import { Button, TextField } from "@material-ui/core";
import React, { useState } from "react";
import "./Login.css";
import PropsTypes from "prop-types";
import axios from "../axios";

const loginUser = async ({ username, password }) => {
  return axios
    .post("/login", {
      username: username,
      password: password,
    })
    .then((response) => response);
};

const Login = (props) => {
  const { setToken } = props;

  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const onSubmit = async (e) => {
    e.preventDefault();
    if (!username && !password) {
      alert("please insert username and password");
      return;
    }

    const token = await loginUser({ username, password });
    setToken(token.data.data);

    setUsername("");
    setPassword("");
  };

  return (
    <div className="login">
      <div className="register-form">
        <h2>Login</h2>
        <form onSubmit={onSubmit}>
          <div className="input-text">
            <TextField
              label="User Name"
              type="text"
              variant="outlined"
              id="MuiInputBase-input"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
            />
          </div>

          <div className="input-text">
            <TextField
              label="Password"
              type="password"
              variant="outlined"
              id="MuiInputBase-input"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <div className="button">
            <Button variant="contained" color="primary" type="submit">
              Login
            </Button>
          </div>
          <div className="link"></div>
        </form>
      </div>
    </div>
  );
};

Login.prototype = {
  setToken: PropsTypes.func.isRequired,
};
export default Login;
