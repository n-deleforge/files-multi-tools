<?php
// =========
// ==== MAIN

require("config.php");
callApp();

/*
    Call the app main menu
*/

function callApp() {
    popen("cls", "w");
    displayTitle("Files Multi Tools", 1);

    echo LANG["menuVersion"] . " : " . VERSION;

    displayTitle(LANG["menuTitle"]);
    echo "1 - " . LANG["app1Name"] . "\n";
    echo "2 - " . LANG["app2Name"] . "\n";
    echo "3 - " . LANG["app3Name"] . "\n\n";

    $choice = readline(LANG["menuChoice"]);

    if ($choice === "1") listFiles();
    if ($choice === "2") compareFiles();
    if ($choice === "3") randomRenaming();
    callApp();
}

// ===================
// ==== APPS FUNCTIONS

/*
    App 1 : List all the files from a directory
*/

function listFiles() {
    popen("cls", "w");
    displayTitle(LANG["app1Name"]);

    // Ask informations
    $path = readLine2(LANG["app1Question1"]);
    $extension = readline(LANG["app1Question2"]);
    $prefix = readline(LANG["app1Question3"]);

    // Scan the directory
    $scan = array_diff(scandir($path), array('..', '.'));

    // Open the text file and write each line
    $file = fopen("output.txt", "w");
    foreach ($scan as $line) {
        if (!empty($extension)) $line = str_replace("." . $extension, "", $line);
        fwrite($file, $prefix . $line . "\n");
    }

    fclose($file);
    backToMenu();
}

/*
    App 2 : Compare two files
*/

function compareFiles() {
    popen("cls", "w");
    displayTitle(LANG["app2Name"]);

    // Ask informations
    $fileA = readline2(LANG["app2Question1"]);
    $fileB = readline2(LANG["app2Question2"]);

    echo "\n" . LANG["app2Waiting1"] . "\n";

    // Calculate hash MD5
    $md5FileA = md5_file($fileA);
    $md5FileB = md5_file($fileB);

    echo LANG["app2Waiting2"] . "\n";

    // Calculate hash SHA1
    $sha1FileA = sha1_file($fileA);
    $sha1FileB = sha1_file($fileB);

    echo LANG["app2Waiting3"] . "\n\n";

    // Check the hash
    echo (($sha1FileA != $sha1FileB) && ($md5FileA != $md5FileB)) ? LANG["app2Success"] : LANG["app2Error"];
    
    backToMenu();
}

/*
    App 3 : Randomly rename all files in a folder
*/

function randomRenaming() {
    popen("cls", "w");
    displayTitle(LANG["app3Name"]);

    // Ask informations
    $path = readLine2(LANG["app3Question1"]);
    echo "\n";
    $security = readline(LANG["app3Question2"]);

    // Add an anti-slash
    $test = substr($path, -1);
    if ($test != "\\") $path = $path . "\\";

    if ($security == "Yes" || $security == "yes" || $security == "YES" || $security == "y" || $security == "Y") {
        // Scan the directory
        $scan = array_diff(scandir($path), array('..', '.'));

        // Renaming
        foreach ($scan as $file) {
            $data = explode(".", $file);
            $extension = end($data);

            rename($path . $file, $path . randomValue() . "." . $extension);
        }

        backToMenu();
    } else backToMenu();
}

// ================
// ==== Misc functions

/*
    Check the answer : not empty and a correct path needed
*/

function readLine2($question) {
    $errors = 0;
    $listErrors = [];
    $response = readline($question);

    // Check if it's empty
    if (empty($response)) {
        $errors++;
        array_push($listErrors, LANG["readline2Empty"]);
    }

    // Check if it's existing
    if (!file_exists($response) || !is_dir($response)) {
        $errors++;
        array_push($listErrors, LANG["readline2PathError"]);
    }

    // Display errors
    if ($errors > 0) {
        // Display every errors
        foreach ($listErrors as $msgError) echo " > " . $msgError . "\n";

        // Ask again the question
        echo "\n";
        readLine2($question);
    }

    return $response;
}

/*
    Return to the main menu
*/

function backToMenu() {
    readline();
    callApp();
}

/*
    Display title in the interface
*/

function displayTitle($title, $breakLine = 2) {
    echo ($breakLine == 1) ? "\n===== " . $title . " ===== \n\n" : "\n\n===== " . $title . " ===== \n\n";
}

/*
    Generate a random value
*/

function randomValue($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Output the 36 character UUID.
    return vsprintf('%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}
