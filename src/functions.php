<?php

/**
  * ==== MENU ====
 */

/**
 * Call the main menu
 */

function callMenu() {
    clearScreen();
    displayText("Files Multi Tools", "main-title");

    // Diplay informations
    displayText(LANG["menuInfoVersion"] . " : " . VERSION, "normal-text-with-br");
    displayText(LANG["menuInfoOS"] . "  : " . OS, "normal-text-with-br");
    displayText(LANG["menuInfoAuthor"] . "  : n-deleforge", "normal-text-with-br");
    displayText("Github  : https://github.com/n-deleforge/files-multi-tools", "normal-text-with-double-br");
    displayText(LANG["menuInfoExit"], "information");

    // Listing categories
    foreach (CATEGORIES as $categorie) {
        ($categorie["id"] === 1) ? displayText($categorie["title"], "second-title-a") : displayText($categorie["title"], "second-title-b");

        // List scripts per categories
        foreach (SCRIPTS as $script) {
            if ($categorie["id"] === $script["categorie"]) {
                echo "[" . $script["id"] . "] " . $script["title"];
                breakLine(1);
            }
        }
    };

    // Ask choice
    $choice = readline2(breakLine(1) . LANG["menuChoice"], "no-rules");

    // Check if the user wants to quit
    if ($choice === "!e" || $choice === "!E") {
        clearScreen();
        exit();
    } 
    
    // Check if the input corresponds to one script
    else {
        foreach (SCRIPTS as $script) {
            if ($script["id"] === $choice || lcfirst($script["id"]) === $choice) {
                // Check if there are arguments to add to the call function
                (!$script["argument"]) ? call_user_func($script["function"]) : call_user_func($script["function"], $script["argument"]);
            }
        }
    }

    // If the input is incorrect, recall the function
    callMenu();
}

/**
 * Return to the main menu
 */

function backToMenu() {
    readline();
    callMenu();
}

/**
  * ==== STYLE ====
 */

/**
 * Break a certain number of llines
 * @param integer $nb   Number of lines
 */

function breakLine($nb) {
    for ($i = 0; $i < $nb; $i++) {
        echo "\n";
    }
}

/**
 * Clear the console screen
 */

function clearScreen() {
    (OS === "Windows") ? popen("cls", "w") : popen("clear", "w");
}

/**
 * Display a bunch of informations when a script is called
 * @param string $title         Title to display
 * @param string $warning  Warning to display (is null by default)
 */

function newScreen($title, $warning = null) {
    clearScreen();
    displayText($title, "main-title");

    if ($warning !== null) {
        displayText($warning, "warning");
    }

    displayText(LANG["menuScriptExit"], "information-with-double-br");
}

/**
 * Display text with different styles
 * @param string $text      Text to display
 * @param string $style     Style to apply
 */

function displayText($text, $style) {
    switch ($style) {
            // Normal text
        case "normal-text-with-br":
            echo $text;
            breakLine(1);
            break;
        case "normal-text-with-double-br":
            echo $text;
            breakLine(2);
            break;
        case "normal-text-with-br-before":
            breakLine(1);
            echo $text;
            break;
        case "normal-text-with-br-around":
            breakLine(1);
            echo $text;
            breakLine(1);
            break;

            // Titles
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

            // Special texts
        case "warning":
            echo "\e[91m/!\\ " . $text . "\e[0m";
            breakLine(2);
            break;
        case "information":
            echo "\e[33m>> " . $text . "\e[0m";
            breakLine(1);
            break;
        case "information-with-double-br":
            echo "\e[33m>> " . $text . "\e[0m";
            breakLine(2);
            break;
    }
}

/**
  * ==== CHECKING ====
 */

/**
 * Check a readline with different rules
 * @param string $question  Text of the question asked
 * @param string $rules        Rule to check (optional, not-optional, file, folder)
 */

function readLine2($question, $rules) {
    $errors = 0;
    $listErrors = array();
    $response = readline($question);

    // First, let's check if the user wants to leave the script
    if ($response === "!m" || $response === "!M") {
         callMenu();
    }

    // Then, remove possible quote marks added with drag and drog
    if (!empty($response) && $response[0] === "\"" && substr($response, -1) === "\"") {
        $response = str_replace("\"", "", $response);
    }

    // If rules are activated
    if ($rules !== "optional") {
        // It can't be empty
        if (empty($response)) {
            $errors++;
            array_push($listErrors, LANG["readline2Empty"]);
        }

        // Folder rules
        if ($rules === "folder") {
            // Check folder localisation
            if (!is_dir($response)) {
                $errors++;
                array_push($listErrors, LANG["readline2PathFolder"]);
            }

            // Add antislash to avoid errors
            $response = addAntiSlash($response);
        }

        // Files rules
        if ($rules === "file") {
            // Check file localisation
            if (!is_file($response)) {
                $errors++;
                array_push($listErrors, LANG["readline2PathFile"]);
            }
        }

        // If there are errors during the checks
        if ($errors > 0) {
            // Display errors
            foreach ($listErrors as $msgError) {
                displayText(" > " . $msgError, "normal-text-with-br");
            }

            // Then, ask again the question
            return readLine2(breakLine(1) . $question, $rules);
        }
    }

    // If there no errors or no rules, return the response
    return $response;
}

/**
 * Add an antislash if needed
 * @param string $str   String to check
 */

function addAntiSlash($str) {
    $characterToCheck = (OS === "Windows") ? "\\" : "/";
    return (substr($str, -1) != $characterToCheck) ? $str . $characterToCheck : $str;
}

/**
  * ==== MISC ====
 */

/**
 * Generate a random value
 */

function randomValue() {
    $random = random_bytes(16);
    assert(strlen($random) == 16);
    return vsprintf('%s%s%s%s%s%s', str_split(bin2hex($random), 4));
}
