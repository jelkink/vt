<?php

ini_set('display_errors', '1');

$path_to_library = "../library/";

require_once($path_to_library . "classes/class.database.inc.php");
require_once($path_to_library . "classes/class.httpcontext.inc.php");
require_once($path_to_library . "classes/class.session.inc.php");
require_once($path_to_library . "classes/class.gui.inc.php");

$dbh = new Database;
$gui = new GUI;

$msg = HTTPContext::getString("message", null, false);
$gui->AddRight("<font color=\"red\">$msg</font>\n");

$gui->AddHeader("<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-3.2.1.min.js\"></script>");
// $gui->AddHeader("<script type=\"text/javascript\" src=\"scripts/main.js\"></script>");

if (!$dbh->open()) {

	$gui->AddCenter("<p>ERARO: Ne povas aliri datumbazon.</p>");
} else {

	$page = HTTPContext::getString('page', '');
	$session = new Session($dbh);

	if ($page == '') {

		$gui->AddCenter($session->LoginForm());
	} else if ($page == "login") {

		include("page.login.inc.php");
	} else {

		if ($session->VerifyLogin(HTTPContext::getString('session', ''))) {

			$gui->AddLeft("Ensalutinta kiel $session->login<br/><br/>\n" .
			"<br /><br /><a href=\"index.php?page=logout&session=$session->id\">Elsaluti</a><br />\n");

			if (file_exists("pages/page." . $page . ".inc.php")) {

				include("pages/page." . $page . ".inc.php");
			} else {

				$msg = "ERARO: Paĝo " . $page . " ne ekzistas.";
				header("Location: index.php?session=$session->id&message=" . urlencode($msg));
			}
		} else {

			$msg = "ERARO: Sesio nevalida.";
			header("Location: index.php?message=" . urlencode($msg));
		}
	}
}

$gui->Render();

?>
