<?php

// ===================
// ==== MENU AND STYLE

/**
 * Call the main menu
 * @return void
 */ 

function callMenu() {
    clearScreen();
    displayText("Files Multi Tools", "main-title");

    // Diplay informations
    echo LANG["menuVersion"] . " : " . VERSION;
    breakLine(1);
    echo LANG["menuAuthor"] . "  : n-deleforge";
    breakLine(1);
    echo "Github  : https://github.com/n-deleforge/files-multi-tools";
    breakLine(2);
    displayText(LANG["menuExit"], "information");

    // Listing categories
    foreach(CATEGORIES as $categorie) {
        ($categorie["id"] === 1) ? displayText($categorie["title"], "second-title-a") : displayText($categorie["title"], "second-title-b");

        // List scripts per categories
        foreach(SCRIPTS as $script) {
            if ($categorie["id"] === $script["categorie"]) {
                echo $script["id"] . " - " . $script["title"];
                breakLine(1);
            }
        }
    };

    breakLine(1);

    // Ask choice
    $choice = readline2(LANG["menuChoice"]);
    if ($choice === "!e" || $choice === "!E") {
        clearScreen();
        exit();
    }
    else {
        foreach(SCRIPTS as $script)
            if ($script["id"] == $choice) call_user_func($script["function"]);
    }

    callMenu();
}

/**
 * Break X lines
 * @param integer $nbLines
 */ 

function breakLine($nbLines) {
    for ($i = 0; $i < $nbLines; $i++) echo "\n";
}

/**
 * Clear the console
 */ 

function clearScreen() {
    popen("cls", "w");
}

/**
 * Display a new script with appropriate informations
 * @param string $title
 * @param string $warning
 */ 

function newScreen($title, $warning = null) {
    clearScreen();
    displayText($title, "main-title");
    if ($warning != null) displayText($warning, "warning");
    displayText(LANG["menuScriptExit"], "information");
    breakLine(2);
}

/**
 * Return to the main menu
 */ 

function backToMenu() {
    readline();
    callMenu();
}

/**
 * Display text with different styles
 * @param string $text
 * @param string $style
 */ 

function displayText($text, $style) {
    switch ($style) {
        case "main-title":
            echo "===== \e[34m" . strtoupper($text) . "\e[0m =====";
            breakLine(2);
            break;
        case "second-title-a":
            breakLine(2);
            echo "===== \e[94m" . $text . "\e[0m =====";
            breakLine(2);
            break;
        case "second-title-b":
            breakLine(1);
            echo "===== \e[94m" . $text . "\e[0m =====";
            breakLine(2);
            break;
        case "warning":
            echo "\e[91m/!\\ " . $text . "\e[0m";
            breakLine(2);
            break;
        case "information":
            echo "\e[33m>> " . $text . "\e[0m";
            break;
    }
}

/**
 * Check a readline with different rules
 * @param string $question
 * @param string $rules
 */ 

function readLine2($question, $rules = null) {
    $errors = 0;
    $listErrors = [];
    $response = readline($question);

    // Able to quit every scripts with the `!m` command
    if ($response === "!m" || $response === "!M") callMenu();

    // Able to activate or not rules
    if ($rules !== null)  {
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

        // If there are some errors
        if ($errors > 0) {
            foreach ($listErrors as $msgError) {
                echo " > " . $msgError;
                breakLine(1);
            }

            // Ask again the question
            breakLine(1);
            readLine2($question, $rules);
        }
    }

    return $response;
}

// ===================
// ==== MISC FUNCTIONS

/**
 * Add an antislash if needed
 * @param string $str
 */ 

function addAntiSlash($str) {
    return (substr($str, -1) != "\\") ? $str . "\\" : $str;
}

/**
 * Generate a random value
 * @param string $data
 */ 

function randomValue($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Output the 36 character UUID.
    return vsprintf('%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}
