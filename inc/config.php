<?php
// =============
// ==== SETTINGS

define("VERSION", "0.2.1");
define("LANG", $english);

// ===========================
// ==== CATEGORIES AND SCRIPTS

define("CATEGORIES", [
    ["id" => 1, "title" => LANG["menuTitle1"]], 
    ["id" => 2, "title" => LANG["menuTitle2"]], 
]);

define("SCRIPTS", [
    ["categorie" => 1, "id" => 10, "title" => LANG["listFilesName"], "function" => "listFiles"],
    ["categorie" => 1, "id" => 11, "title" => LANG["randomRenamingName"], "function" => "randomRenaming"],
    ["categorie" => 1, "id" => 12, "title" => LANG["modifyExtensionName"], "function" => "modifyExtension"],
    ["categorie" => 2, "id" => 20, "title" => LANG["compareFilesName"], "function" => "compareFiles"],
]);