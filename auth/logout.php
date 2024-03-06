<?php

session_start();
require_once '../functions/helper.php';
session_destroy();
redirect('/auth/login.php');