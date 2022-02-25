<?php
// ==============
// ==== MISC DATA

define("LANG", [
    // Menu
    "menuVersion" => "Version",
    "menuAuthor" => "Author",
    "menuOS" => "System",
    "menuTitle1" => "Bulk file operations (in a folder)",
    "menuTitle2" => "Specific file operations",
    "menuTitle9" => "Others",
    "menuExit" => "Enter `!e` to stop and exit the script now.",
    "menuScriptExit" => "Enter `!m` to go back to the main menu.",
    "menuChoice" => "Your choice : ",

    // Script : listFiles
    "listFilesName" => "List all files",
    "listFilesQuestion1" => "Folder path : ",
    "listFilesQuestion2" => "File format to delete (optionnel) : ",
    "listFilesQuestion3" => "Prefix (optionnel) : ",
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
    "modifyExtensionWarn" => "Be careful with this script. It will modify all files extension and it may corrupt files. Indeed, it doesn't 'convert' files. For example, you can modify JPG to PNG or XT to MD (similar extensions ONLY).",
    "modifyExtensionQuestion1" => "Directory path : ",
    "modifyExtensionQuestion2" => "New extension : ",
    "modifyExtensionDone" => "Every files extension has been modified in the following folder : ",

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
    "Desktop.ini",

    // Synology devices
    "@eaDir",
]);

// =============
// ==== SETTINGS

define("VERSION", "0.2.2");
define("OS", strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? "Windows" : "Linux");

// =========================
// ==== CATEGORIES + SCRIPTS

define("CATEGORIES", [
    ["id" => "A", "title" => LANG["menuTitle1"]], 
    ["id" => "B", "title" => LANG["menuTitle2"]], 
]);

define("SCRIPTS", [
    ["categorie" => "A", "id" => "A1", "title" => LANG["listFilesName"], "function" => "listFiles"],
    ["categorie" => "A", "id" => "A2", "title" => LANG["randomRenamingName"], "function" => "randomRenaming"],
    ["categorie" => "A", "id" => "A3", "title" => LANG["modifyExtensionName"], "function" => "modifyExtension"],
    ["categorie" => "B", "id" => "B1", "title" => LANG["compareFilesName"], "function" => "compareFiles"],
]);