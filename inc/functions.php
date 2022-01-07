<?php

// ===================
// ==== MENU AND STYLE

/*
    Call the main menu
*/

function callMenu() {
    popen("cls", "w");
    displayTitle("Files Multi Tools", 0);

    // Diplay informations
    echo LANG["menuVersion"] . " : " . VERSION;
    breakLine(1);
    echo LANG["menuAuthor"] . "  : n-deleforge";
    breakLine(2);
    echo LANG["menuExit"];

    // Listing categories
    foreach(CATEGORIES as $categorie) {
        ($categorie["id"] === 1) ? displayTitle($categorie["title"], 1) : displayTitle($categorie["title"], 2);

        // List apps per categories
        foreach(APPS as $app) {
            if ($categorie["id"] === $app["categorie"]) {
                echo $app["id"] . " - " . $app["title"];
                breakLine(1);
            }
        }
    };

    breakLine(1);

    // Ask choice
    $choice = readline(LANG["menuChoice"]);
    if ($choice === "e" || $choice === "E") {
        popen("cls", "w");
        die();
        exit();
    }
    else {
        foreach(APPS as $app)
            if ($app["id"] == $choice) call_user_func($app["function"]);
    }

    callMenu();
}

/*
    Break line X times
*/

function breakLine($nbLines) {
    for ($i = 0; $i < $nbLines; $i++) echo "\n";
}

/*
    Return to the main menu
*/

function backToMenu() {
    readline();
    callMenu();
}

/*
    Display title in the interface
*/

function displayTitle($text, $style) {
    switch ($style) {
        case 0:
            // Main title
            echo "===== \e[34m" . strtoupper($text) . "\e[0m =====";
            breakLine(2);
            break;
        case 1:
            // Second title
            breakLine(2);
            echo "===== \e[96m" . $text . "\e[0m =====";
            breakLine(2);
            break;
        case 2:
            // Second title with only one line
            breakLine(1);
            echo "===== \e[96m" . $text . "\e[0m =====";
            breakLine(2);
            break;
    }
}

/*
    Check the answer : not empty and a correct path needed
*/

function readLine2($question, $rules) {
    $errors = 0;
    $listErrors = [];
    $response = readline($question);

    // Check if it's empty
    if (empty($response)) {
        $errors++;
        array_push($listErrors, LANG["readline2Empty"]);
    }

    if ($rules === "folder") {
        if (!is_dir($response)) {
            $errors++;
            array_push($listErrors, LANG["readline2PathFolder"]);
        }
    }
    
    if ($rules === "file") {
        if (!is_file($response)) {
            $errors++;
            array_push($listErrors, LANG["readline2PathFile"]);
        }
    }


    // Display errors
    if ($errors > 0) {
        // Display every errors
        foreach ($listErrors as $msgError) {
            echo " > " . $msgError;
            breakLine(1);
        }

        // Ask again the question
        breakLine(1);
        readLine2($question, $rules);
    }

    return $response;
}

// ===================
// ==== MISC FUNCTIONS

/*
    Add an anti slash at the end of a string (if not present)
*/

function addAntiSlash($str) {
    return (substr($str, -1) != "\\") ? $str . "\\" : $str;
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
