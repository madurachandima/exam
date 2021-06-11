import React from "react";

function User(props) {
  const { id, user_name } = props;

  return (
    <div>
      <h5>{id}</h5>
      <h5>{user_name}</h5>
    </div>
  );
}

export default User;
