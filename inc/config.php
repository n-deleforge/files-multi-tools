<?php

// ===============
// ==== CONSTANTS

define("VERSION", 0.2);
define("LANG", $english);

// ========================
// ==== CATEGORIES AND APPS

define("CATEGORIES", [
    ["id" => 1, "title" => LANG["menuTitle1"]], 
    ["id" => 2, "title" => LANG["menuTitle2"]], 
]);

define("APPS", [
    ["categorie" => 1, "id" => 10, "title" => LANG["listFilesName"], "function" => "listFiles"],
    ["categorie" => 1, "id" => 11, "title" => LANG["randomRenamingName"], "function" => "randomRenaming"],
    ["categorie" => 2, "id" => 20, "title" => LANG["compareFilesName"], "function" => "compareFiles"],
]);