<?php

// delete cookie
setcookie(	"authorized", 
			"", 
			(time() - 3600), 
			"/", 
			"themarket.com"
);

// redirect
header("Location: /account/index.php");
exit();