<?php

class Session {

  function Session()
  {
  }

  function LoginForm() {
    $s = "

<form method=\"POST\" action=\"index.php?page=login\" class=\"form1\">
  <table>
    <tr><td>Uzantnomo:</td><td><input type=\"text\" size=20 class=\"input-field\" name=\"username\"></td></tr>
    <tr><td>Pasvorto:</td><td><input type=\"password\" size=20 class=\"input-field\" name=\"password\"></td></tr>
    <tr><td colspan=2><input type=\"submit\" text=\"Ensaluti\"></td></tr>
  </table>
</form>

";

    return $s;
  }

  function Create($login) {

    $this->id = uniqid();

    do_query("INSERT INTO sessions (id, username) VALUES (\"$this->id\", \"$login\")");

    return $this->id;
  }

  function VerifyLogin($id) {

    if (ctype_alnum($id)) {

      $res = mysqli_fetch_object(do_query("SELECT username FROM sessions WHERE id = \"$id\""));

      if ($res) {

        $this->username = $res->username;
        $this->id = $id;

        return true;
      }
    }

    return false;
  }

  function Logout() {

    do_query("DELETE FROM sessions WHERE username = \"$this->username\"");
  }
}

?>
