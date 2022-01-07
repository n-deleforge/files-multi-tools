<?php

/*
    List all the files from a directory
*/

function listFiles() {
    popen("cls", "w");
    displayTitle(LANG["listFilesName"], 0);

    // Ask informations
    $path = readLine2(LANG["listFilesQuestion1"], "folder");
    $path = addAntiSlash($path);
    $extension = readline(LANG["listFilesQuestion2"]);
    $prefix = readline(LANG["listFilesQuestion3"]);

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
    popen("cls", "w");
    displayTitle(LANG["compareFilesName"], 0);

    // Ask informations
    $fileA = readline2(LANG["compareFilesQuestion1"], "file");
    $fileB = readline2(LANG["compareFilesQuestion2"], "file");

    breakLine(1);
    echo LANG["compareFilesWaiting1"];
    breakLine(1);

    // Calculate hash MD5
    $md5FileA = md5_file($fileA);
    $md5FileB = md5_file($fileB);

    echo LANG["compareFilesWaiting2"];
    breakLine(1);

    // Calculate hash SHA1
    $sha1FileA = sha1_file($fileA);
    $sha1FileB = sha1_file($fileB);

    echo LANG["compareFilesWaiting3"];
    breakLine(2);

    // Check the hash
    echo (($sha1FileA === $sha1FileB) && ($md5FileA === $md5FileB)) ? LANG["compareFilesSuccess"] : LANG["compareFilesError"];
    
    backToMenu();
}

/*
    Randomly rename all files in a folder
*/

function randomRenaming() {
    popen("cls", "w");
    displayTitle(LANG["randomRenamingName"], 0);

    // Ask informations
    $path = readLine2(LANG["randomRenamingQuestion1"], "folder");
    $path = addAntiSlash($path);
    breakLine(1);
    $security = readline(LANG["randomRenamingQuestion2"]);

    if ($security == "Yes" || $security == "yes" || $security == "YES" || $security == "y" || $security == "Y") {
        // Scan the directory
        $scan = array_diff(scandir($path), array('..', '.'));

        // Renaming
        foreach ($scan as $file) {
            $data = explode(".", $file);
            $extension = end($data);
            rename($path . $file, $path . randomValue() . "." . $extension);
        }

        breakLine(1);
        echo LANG["randomRenamingDone"] . $path;
        backToMenu();
    } 
    
    else {
        breakLine(1);
        echo LANG["randomRenamingCancelled"];
        backToMenu();
    }
}