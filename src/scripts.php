<?php

/**
 * Contains all the scripts called by the user.
 */

/**
 * List all the files from a directory
 */ 

function listFiles() {
    newScreen(LANG["listFilesName"], LANG["listFilesNameInfo"]);

    // Ask informations
    $path = readLine2(LANG["listFilesQuestion1"], "folder");
    $extension = readline2(LANG["listFilesQuestion2"], "optional");
    $prefix = readline2(LANG["listFilesQuestion3"], "optional");

    // Scan the directory
    $scan = array_diff(scandir($path), EXCLUDED);

    // Open the text file and write each line
    $file = fopen($path . "output.txt", "w");
    foreach ($scan as $line) {
        // Remove extension if asked
        if (!empty($extension)) {
            $line = str_replace("." . $extension, "", $line);
        }
        fwrite($file, $prefix . $line . "\n");
    }

    // Close file and alert user it's done
    fclose($file);
    displayText(LANG["listFilesDone"] . $path . "output.txt", "success", 1, 0);
    backToMenu();
}

/**
 * Compare two files
 */ 

function compareFiles() {
    newScreen(LANG["compareFilesName"], LANG["compareFilesInfo"]);

    // Ask informations
    $fileA = readline2(LANG["compareFilesQuestion1"], "file");
    $fileB = readline2(LANG["compareFilesQuestion2"], "file");
    displayText(LANG["compareFilesWaiting1"] , "normal-text", 1, 1);

    // Calculate hash MD5
    $md5FileA = md5_file($fileA);
    $md5FileB = md5_file($fileB);

    // Display MD5 informations
    displayText("MD5", "second-title", 1, 1);
    displayText("A : " . $md5FileA, "normal-text");
    displayText("B : " . $md5FileB, "normal-text", 0, 2);
    displayText(LANG["compareFilesWaiting2"], "normal-text", 0, 1);

    // Calculate hash SHA1
    $sha1FileA = sha1_file($fileA);
    $sha1FileB = sha1_file($fileB);

    // Display SHA1 informations
    displayText("SHA1", "second-title", 1, 1);
    displayText("A : " . $sha1FileA, "normal-text");
    displayText("B : " . $sha1FileB, "normal-text", 0, 2);

    // Check the hash and alert user
    if (($md5FileA == $md5FileB) && ($sha1FileA == $sha1FileB))
        displayText(LANG["compareFilesSuccess"], "success", 0, 0);
    else
        displayText(LANG["compareFilesError"], "error", 0, 0);

    backToMenu();
}

/**
 * Randomly rename all files in a folder
 */ 

function randomRenaming() {
    newScreen(LANG["randomRenamingName"],  LANG["randomRenamingInfo"]);

    // Ask informations
    $path = readLine2(LANG["randomRenamingQuestion1"], "folder");

    // Scan the directory
    $scan = array_diff(scandir($path), EXCLUDED);

    // Renaming
    foreach ($scan as $file) {
        if (is_file($path . $file)) {
            // Split name and extension
            $data = explode(".", $file);
            $extension = end($data);

            // Rename files with random names
            rename($path . $file, $path . randomValue() . "." . $extension);
        }
    }

    // Alert user it's done
    displayText(LANG["randomRenamingDone"] . $path, "success", 1, 0);
    backToMenu();
}

/**
 * Modify every files extension from a directory
 */ 

function modifyExtension() {
    newScreen(LANG["modifyExtensionName"], LANG["modifyExtensionInfo"]);

    // Ask informations
    $path = readLine2(LANG["modifyExtensionQuestion1"], "folder");
    $extension = readline2(LANG["modifyExtensionQuestion2"], "empty");

    // Scan the directory
    $scan = array_diff(scandir($path), EXCLUDED);

    foreach ($scan as $file) {
        if (is_file($path . $file)) {
            // Keep name and remove extension
            $name = explode(".", $file);
            array_splice($name, count($name) - 1);

            // Rename with original name but new extension
            $name = implode(".", $name);
            rename($path . $file, $path . $name . "." . $extension);
        }
    }

    // Alert user it's done
    displayText(LANG["modifyExtensionDone"] . $path, "success", 0, 0);
    backToMenu();
}

/**
 * Compare one file with MD5 hash
 * @param string $hash  Name of the hash (MD5 or SHA1)
 */ 

function compareFileWithHash($hash) {
    if ($hash === "MD5") {
        newScreen(LANG["compareFileWithHashMD5Name"], LANG["compareFileWithHashInfo"]);
    }
    elseif ($hash === "SHA1") {
        newScreen(LANG["compareFileWithHashSHA1Name"], LANG["compareFileWithHashInfo"]);
    }

    // Ask informations
    $file = readline2(LANG["compareFileWithHashQuestion1"], "file");
    $checkHash = readline2(LANG["compareFileWithHashQuestion2"], "not-optional");
    displayText(LANG["compareFileWithHashWaiting"], "normal-text", 1, 1);

    // Calculate hash
    if ($hash === "MD5") {
        $fileHash = md5_file($file);
    }
    elseif ($hash === "SHA1") {
        $fileHash = sha1_file($file);
    }
    
    // Display results
    displayText(LANG["compareFileWithHashResult1"] . $fileHash, "normal-text");
    displayText(LANG["compareFileWithHashResult2"] . $checkHash, "normal-text", 0, 2);

    // Check the hash and alert user
    if ($fileHash == $checkHash) {
        displayText(LANG["compareFileWithHashSuccess"], "success", 1, 0);
    }
    else {
        displayText(LANG["compareFileWithHashError"], "error", 1, 0);
    }

    backToMenu();
}

/**
 * Compare two strings
 */ 

function compareTwoStrings() {
    newScreen(LANG["compareTwoStringsName"], LANG["compareTwoStringsInfo"]);

    // Ask informations
    $strA = readline2(LANG["compareTwoStringsQuestion1"], "not-optional");
    $strB = readline2(LANG["compareTwoStringsQuestion2"], "not-optional");

    // Check the differences and alert user
    if ($strA === $strB) {
        displayText(LANG["compareTwoStringsSuccess"], "success", 1, 0);
    }
    else {
        displayText(LANG["compareTwoStringsError"], "error", 1, 0);
    }

    backToMenu();
}