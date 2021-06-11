import React, { useEffect, useState } from "react";
import axios from "../axios";
import User from "./User";

function ShowAllUsers(props) {
  const { token } = props;
  const [users, setUsers] = useState([]);

  useEffect(() => {
    axios
      .post(
        "/getall",
        {},
        {
          headers: {
            Authorization: token,
          },
        }
      )
      .then((response) => {
        response.data.data.length > 0 ? (
          setUsers(response.data.data)
        ) : (
          <h4>No Users Found</h4>
        );
      });

    return () => {
      setUsers([]);
      // console.log("call cleanup");
    };
  }, []);

  return (
    <div>
      {users.map((user) => (
        <User key={user.id} {...user} />
      ))}
    </div>
  );
}

export default ShowAllUsers;
