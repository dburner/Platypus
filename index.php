<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Pagini statice
include("handlers/Home.php");
include("handlers/AddCourse.php");
include("handlers/LogOut.php");
include("handlers/AccountSettings.php");

// Pagini Dinamice
include("handlers/courses.php");
include("handlers/lessons.php");

// Obiecte
include("lib/Class.Markdown.php");
include("lib/Class.Validator.php");

// Setari
include("lib/mysql.php");
include("lib/variables.php");
include("lib/queries.php");
include("lib/functions.php");
include("lib/Toro.php");

// Pornim Sesiunea
session_start();

function error_404() {
    include("views/404.php");
}
ToroHook::add("404", "error_404");

Toro::serve(array(
    "/" 								=> "Home",
    "/account-settings" 				=> "AccountSettings",
    "/add-course" 						=> "AddCourse",
    "/log-out" 							=> "LogOut",
    "/courses/:alpha" 					=> "Courses",
    "/courses/:alpha/:alpha" 			=> "Lessons"
));
