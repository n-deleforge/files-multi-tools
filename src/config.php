<?php

/**
  * ==== SETTINGS ====
 */

define("VERSION", "0.2.3");
define("OS", strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? "Windows" : "Linux");

/**
  * ==== DATA ====
 */

define("LANG", [
    // Menu
    "menuInfoVersion" => "Version",
    "menuInfoAuthor" => "Author",
    "menuInfoOS" => "System",
    "menuCategorieA" => "Bulk file operations (in a folder)",
    "menuCategorieB" => "Specific file operations",
    "menuInfoExit" => "Enter `!e` to stop and exit the script now.",
    "menuScriptExit" => "Enter `!m` to go back to the main menu.",
    "menuChoice" => "Choose a script : ",

    // Script : listFiles
    "listFilesName" => "List all files",
    "listFilesQuestion1" => "Folder path : ",
    "listFilesQuestion2" => "File format to delete [optional] : ",
    "listFilesQuestion3" => "Prefix [optional] : ",
    "listFilesDone" => "Listing done in the following file : ",

    // Script : compareFiles
    "compareFilesName" => "Compare two files",
    "compareFilesQuestion1" => "File A path : ",
    "compareFilesQuestion2" => "File B path : ",
    "compareFilesWaiting1" => "Checking in progress, please wait.",
    "compareFilesWaiting2" => "Please wait ...",
    "compareFilesSuccess" => "The two files are identical.",
    "compareFilesError" => "The two files are different.",

    // Script : randomRenaming
    "randomRenamingName" => "Randomly rename all files",
    "randomRenamingWarn" => "Be careful with this script. It will modifiy all filenames.",
    "randomRenamingQuestion1" => "Folder path : ",
    "randomRenamingDone" => "Every files has been renamed in the following folder : ",
    "randomRenamingCancelled" => "Cancel. No files have been renamed.",

    // Script : modifyExtension
    "modifyExtensionName" => "Modify all file extensions",
    "modifyExtensionWarn" => "Be careful with this script. It will modify all files extension and it may corrupt files.",
    "modifyExtensionQuestion1" => "Folder path : ",
    "modifyExtensionQuestion2" => "New extension : ",
    "modifyExtensionDone" => "Every files extension has been modified in the following folder : ",

    // Script : compareFileHash
    "compareFileWithHashMD5Name" => "Compare one file with MD5 hash",
    "compareFileWithHashSHA1Name" => "Compare one file with SHA1 hash",
    "compareFileWithHashQuestion1" => "File path : ",
    "compareFileWithHashQuestion2" => "Verified hash : ",
    "compareFileWithHashWaiting" => "Checking in progress, please wait.",
    "compareFileWithHashResult1" => "File hash : ",
    "compareFileWithHashResult2" => "Verified hash : ",
    "compareFileWithHashSuccess" => "File hash and verified hash are identical.",
    "compareFileWithHashError" => "File hash and verified hash are different.",

    // Function : readline2
    "readline2Empty" => "The value cannot be empty.",
    "readline2PathFolder" => "The folder doesn't exist.",
    "readline2PathFile" => "The file doesn't exist."
]);

define("EXCLUDED", [
    // Linux and Windows
    "..",
    ".",

    // Windows only
    "Thumbs.db",
    "desktop.ini",

    // Synology devices
    "@eaDir",
]);

/**
  * ==== CATEGORIES AND SCRIPTS ====
 */

define("CATEGORIES", [
    ["id" => "A", "title" => LANG["menuCategorieA"]], 
    ["id" => "B", "title" => LANG["menuCategorieB"]],
]);

define("SCRIPTS", [
    ["categorie" => "A", "id" => "A1", "title" => LANG["listFilesName"], "function" => "listFiles"],
    ["categorie" => "A", "id" => "A2", "title" => LANG["randomRenamingName"], "function" => "randomRenaming"],
    ["categorie" => "A", "id" => "A3", "title" => LANG["modifyExtensionName"], "function" => "modifyExtension"],
    ["categorie" => "B", "id" => "B1", "title" => LANG["compareFilesName"], "function" => "compareFiles"],
    ["categorie" => "B", "id" => "B2", "title" => LANG["compareFileWithHashMD5Name"], "function" => "compareFileWithHash", "argument" => "MD5"],
    ["categorie" => "B", "id" => "B3", "title" => LANG["compareFileWithHashSHA1Name"], "function" => "compareFileWithHash", "argument" => "SHA1"],
]);