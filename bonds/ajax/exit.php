<?php

setcookie('log', $login, time() - 3600 * 24 * 30, "/bonds");
echo true;

?>