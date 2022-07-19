<?php

/**
 * ==== MAIN SETTINGS ====
 */

define("VERSION", "0.2.3");
define("OS", strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? "Windows" : "Linux");

/**
 * ==== LANGUAGE STRINGS ====
 */

define("LANG", [
  // Menu
  "menuInfoVersion" => "Version",
  "menuInfoAuthor" => "Author",
  "menuInfoOS" => "System",
  "menuCategorieFile" => "File operations",
  "menuCategorieFolder" => "Folder operations",
  "menuInfoExit" => "Enter `!e` to stop and exit files-multi-tools now.",
  "menuScriptExit" => "Enter `!m` to go back to the main menu.",
  "menuChoice" => "Choose a script : ",
  "menuBackTo" => "Press a touch to return to the main menu.",

  // Script : listFiles
  "listFilesName" => "List all files in a folder",
  "listFilesNameInfo" => "Create a text file named 'output.txt' in the choosen folder which will list every files\nin this specific folder. The extension can be deleted and a prefix can be added.",
  "listFilesQuestion1" => "Folder path : ",
  "listFilesQuestion2" => "Extension to delete (for example : txt, mp3) [let it empty to not use] : ",
  "listFilesQuestion3" => "Prefix to add (for example : -, *) [let it empty to not use] : ",
  "listFilesDone" => "Listing done in the following file : ",

  // Script : compareFiles
  "compareFilesName" => "Compare two files",
  "compareFilesInfo" => "Compare two files with MD5 and SHA1 hashes. According to the file size, it can take a few minutes.",
  "compareFilesQuestion1" => "File A path : ",
  "compareFilesQuestion2" => "File B path : ",
  "compareFilesWaiting1" => "Checking in progress, please wait.",
  "compareFilesWaiting2" => "Please wait ...",
  "compareFilesSuccess" => "The two files are identical.",
  "compareFilesError" => "The two files are different.",

  // Script : randomRenaming
  "randomRenamingName" => "Randomly rename all files in a folder",
  "randomRenamingInfo" => "Gives random names to every files in the choosen folder.",
  "randomRenamingWarn" => "Be careful. All your files names will be modified definitively.",
  "randomRenamingQuestion1" => "Folder path : ",
  "randomRenamingDone" => "Every files has been renamed in the following folder : ",
  "randomRenamingCancelled" => "Cancel. No files have been renamed.",

  // Script : modifyExtension
  "modifyExtensionName" => "Modify all file extensions in a folder",
  "modifyExtensionInfo" => "Modifies extension to every files in the choosen folder.",
  "modifyExtensionWarn" => "Be careful. All your files extension will be modified and it may corrupt your files.",
  "modifyExtensionQuestion1" => "Folder path : ",
  "modifyExtensionQuestion2" => "New extension : ",
  "modifyExtensionDone" => "Every files extension has been modified in the following folder : ",

  // Script : compareFileHash
  "compareFileWithHashMD5Name" => "Compare one file with MD5 hash",
  "compareFileWithHashSHA1Name" => "Compare one file with SHA1 hash",
  "compareFileWithHashInfo" => "Compare one file with MD5 or SHA1 hash. According to the file size, it can take a few minutes.",
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

/**
 * ==== EXCLUDED FILES ====
 */

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
 * ==== SCRIPTS ====
 */

define("SCRIPTS", [
  ["id" => "01", "title" => LANG["compareFilesName"], "function" => "compareFiles"],
  ["id" => "02", "title" => LANG["compareFileWithHashMD5Name"], "function" => "compareFileWithHash", "argument" => "MD5"],
  ["id" => "03", "title" => LANG["compareFileWithHashSHA1Name"], "function" => "compareFileWithHash", "argument" => "SHA1"],
  ["id" => "04", "title" => LANG["listFilesName"], "function" => "listFiles"],
  ["id" => "05", "title" => LANG["randomRenamingName"], "function" => "randomRenaming"],
  ["id" => "06", "title" => LANG["modifyExtensionName"], "function" => "modifyExtension"],
]);
