<?php

require_once __DIR__ . "/php/authentication.php";

logout();

header("Location: login");
die("Successfuly Logged Out.");