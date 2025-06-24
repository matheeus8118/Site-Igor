<?php
session_start();
session_unset();  // Limpa todas as variáveis da sessão
session_destroy(); // Encerra a sessão
header("Location: index.html");
exit;
?>
