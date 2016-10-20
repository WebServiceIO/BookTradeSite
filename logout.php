<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
session_start();
session_destroy();
header('Location: index.php');