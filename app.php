<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$page = $_REQUEST['page'] ?? '';
include __DIR__ . "/templates/header.php";

switch ( $page ) {
    case "search":
        include "templates/search.php";
        break;
    case "insert":
        include "templates/insert.php";
        break;
    case "delete":
        include "templates/delete.php";
        break;
    case "update":
        include "templates/update.php";
        break;
    case "register":
        include "templates/register.php";
        break;
    case "login":
        include "templates/login.php";
        break;
    case "logout":
        include "templates/logout.php";
        break;
    case "home":
        include "templates/home.php";
        break;
    case "":
        include "templates/home.php";
        break;
    default:
        include "templates/error.php";
        break;
}

include __DIR__ . "/templates/footer.php";