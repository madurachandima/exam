import axios from "../axios";
import React from "react";
import ShowAllUsers from "./ShowAllUsers";

const logOutUser = async (token) => {
  console.log("Token", token);
  return axios
    .post(
      "/logout",
      {},
      {
        headers: {
          Authorization: token,
        },
      }
    )
    .then((response) => response);
};

function DashBorad(props) {
  const { getToken, setToken } = props;

  const logOutClick = async (e) => {
    e.preventDefault();
    const resp = await logOutUser(getToken);
    if (resp.data.data === "" || resp.data.data) setToken("");
  };

  return (
    <div>
      <h3>Dash board</h3>
      <button type="submit" onClick={logOutClick}>
        log out
      </button>
      <h3>Show All users</h3>
      {getToken !== "" ? (
        <ShowAllUsers token={getToken} />
      ) : (
        <h3>Unauthorized access</h3>
      )}
    </div>
  );
}

export default DashBorad;
