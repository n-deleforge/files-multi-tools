<?php

/*
    List all the files from a directory
*/

function listFiles() {
    newScreen(LANG["listFilesName"]);

    // Ask informations
    $path = readLine2(LANG["listFilesQuestion1"], "folder");
    $path = addAntiSlash($path);
    $extension = readline2(LANG["listFilesQuestion2"]);
    $prefix = readline2(LANG["listFilesQuestion3"]);

    // Scan the directory
    $scan = array_diff(scandir($path), array('..', '.'));

    // Open the text file and write each line
    $file = fopen($path . "output.txt", "w");
    foreach ($scan as $line) {
        if (!empty($extension)) $line = str_replace("." . $extension, "", $line);
        fwrite($file, $prefix . $line . "\n");
    }

    // Close file and alert user it's done
    fclose($file);
    breakLine(1);
    echo LANG["listFilesDone"] . $path . "output.txt";
    backToMenu();
}

/*
    Compare two files
*/

function compareFiles() {
    newScreen(LANG["compareFilesName"]);

    // Ask informations
    $fileA = readline2(LANG["compareFilesQuestion1"], "file");
    $fileB = readline2(LANG["compareFilesQuestion2"], "file");

    breakLine(1);
    echo LANG["compareFilesWaiting1"];
    breakLine(1);

    // Calculate hash MD5
    displayText("MD5", "second-title-b");
    $md5FileA = md5_file($fileA);
    $md5FileB = md5_file($fileB);

    echo "A : " . $md5FileA;
    breakLine(1);
    echo "B : " . $md5FileB;
    breakLine(2);
    echo LANG["compareFilesWaiting2"];
    breakLine(1);

    // Calculate hash SHA1
    displayText("SHA1", "second-title-b");
    $sha1FileA = sha1_file($fileA);
    $sha1FileB = sha1_file($fileB);

    echo "A : " . $sha1FileA;
    breakLine(1);
    echo "B : " . $sha1FileB;
    breakLine(2);

    // Check the hash and alert user
    echo (($md5FileA == $md5FileB) && ($sha1FileA == $sha1FileB)) ? LANG["compareFilesSuccess"] : LANG["compareFilesError"];
    backToMenu();
}

/*
    Randomly rename all files in a folder
*/

function randomRenaming() {
    newScreen(LANG["randomRenamingName"], LANG["randomRenamingWarn"]);

    // Ask informations
    $path = readLine2(LANG["randomRenamingQuestion1"], "folder");
    $path = addAntiSlash($path);

    // Scan the directory
    $scan = array_diff(scandir($path), array('..', '.'));

    // Renaming
    foreach ($scan as $file) {
        $data = explode(".", $file);
        $extension = end($data);
        rename($path . $file, $path . randomValue() . "." . $extension);
    }

    // Alert user it's done
    breakLine(1);
    echo LANG["randomRenamingDone"] . $path;
    backToMenu();
}

/*
    Modify every files extension from a directory
*/

function modifyExtension() {
    newScreen(LANG["modifyExtensionName"], LANG["modifyExtensionWarn"]);

    // Ask informations
    $path = readLine2(LANG["modifyExtensionQuestion1"], "folder");
    $path = addAntiSlash($path);
    $extension = readline2(LANG["modifyExtensionQuestion2"], "empty");

    // Scan the directory
    $scan = array_diff(scandir($path), array('..', '.'));

    foreach ($scan as $file) {
        $name = explode(".", $file);
        array_splice($name, count($name) - 1);
        $name = implode($name);

        // Renaming
        rename($path . $file, $path . $name . "." . $extension);
    }

    breakLine(1);
    echo LANG["modifyExtensionDone"] . $path;
    backToMenu();
}