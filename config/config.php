<?php

// Autoload of classes
spl_autoload_register(function() {
    include "classes/courses.class.php";
});

ini_set("display_errors", 1);

// DB-settings (localhost)

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBDATABASE", "moment5"); 