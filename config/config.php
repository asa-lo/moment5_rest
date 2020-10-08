<?php

// Autoload of classes
spl_autoload_register(function() {
    include "classes/courses.class.php";
});

ini_set("display_errors", 1);

// DB-settings (localhost)

define("DBHOST", "studentmysql.miun.se");
define("DBUSER", "aslo1900");
define("DBPASS", "c4h2xdrg");
define("DBDATABASE", "aslo1900"); 