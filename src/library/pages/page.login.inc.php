<?php

$login = HTTPContext::getString("login", "");
$password = HTTPContext::getString("password", "");

if (ctype_alnum($login) && ctype_alnum($password)) {

  $res = mysqli_fetch_object(do_query("SELECT password FROM users WHERE username = \"$login\""));

  if (password_verify($password, $res->password)) {

    $session->Create($login);

    $gui->AddCenter("<p>Ensalutu sukcesa. <a href=\"index.php?page=balance&session=$session->id\">Daŭrigi</a>.</p>");
  } else {

    $gui->AddCenter("<p>ERARO: Malĝusta pasvorto aŭ uzantnomo.</p>");
  }
} else {

  $gui->AddCenter("<p>ERARO: Nur alfanombra uzantnomo kaj pasvorto estas akceptitaj.</p>");
}

header("Location: index.php?page=balance&session=$session->id")

?>
