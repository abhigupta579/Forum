<?php
session_start();
// echo "Logging You out...";
session_unset();
session_destroy();
header("location: /forum/index.php");
