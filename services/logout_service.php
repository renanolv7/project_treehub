<?php

session_start();

// limpa variaveis da sessao
$_SESSION = array();

// destruir cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// destruir sessão 
session_destroy();

header("Location: /pages/login.php");
exit;
?> 