<?php

/**
 * =====================================
  * ===== MENU
 * =====================================
 */

/**
 * Call the main menu
 */

function callMenu() {
    clearScreen();
    displayText("Files Multi Tools", "main-title", 0, 2);

    // Diplay informations
    checkUpdate();
    displayText(LANG["menuInfoOS"] . "  : " . OS, "normal-text");
    displayText(LANG["menuInfoAuthor"] . "  : n-deleforge", "normal-text");
    displayText("Github  : https://github.com/n-deleforge/files-multi-tools", "normal-text", 0, 2);
    displayText(LANG["menuInfoExit"], "information");
    displayText(LANG["menuListScript"], "second-title", 1, 1);

    // List scripts
    foreach (SCRIPTS as $script) {
        breakLine(1);
        echo "[" . $script["id"] . "] " . $script["title"];    
    }

    // Ask choice
    $choice = readline2(displayText(LANG["menuChoice"], "normal-text", 2, 0), "optional");

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
    displayText(LANG["menuBackTo"], "information", 2, 0);
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
    // For Windows systems
    if  (OS === "Windows") {
        popen("cls", "w");
    }

    // For Linux systems
    else {
        popen("clear", "w");
    }
}

/**
 * Display a bunch of informations when a script is called
 * @param string $title              Title to display
 * @param string $explication  Explication to display
 */

function newScreen($title, $explication) {
    clearScreen();
    displayText($title, "main-title", 0, 2);
    displayText(LANG["menuScriptExit"], "information", 0, 2);
    displayText($explication, "explication", 0, 2);
    echo "================";
    breakLine(2);
}

/**
 * Display text with different styles
 * @param string $text                          Text to display
 * @param string $style                        Style to apply
*  @param string $breakLineBefore     Number of lines to break before the text (BY DEFAULT : 0)
*  @param string $breakLineAfter        Number of lines to break after the text (BY DEFAULT : 1)
 */

function displayText($text, $style, $breakLineBefore = 0, $breakLineAfter = 1) {
    switch ($style) {
        // Titles
        case "main-title":
            breakLine($breakLineBefore);
            echo "===== \e[34m" . strtoupper($text) . "\e[0m =====";
            breakLine($breakLineAfter);
            break;
        case "second-title":
            breakLine($breakLineBefore);
            echo "===== \e[94m" . $text . "\e[0m =====";
            breakLine($breakLineAfter);
            break;

        // Normal text
        case "normal-text":
            breakLine($breakLineBefore);
            echo $text;
            breakLine($breakLineAfter);
            break;

        // Special texts
        case "success": // Green
            breakLine($breakLineBefore);
            echo "\e[32m⩗ " . $text . "\e[0m";
            breakLine($breakLineAfter);
            break;
         case "error": // Red
            breakLine($breakLineBefore);
            echo "\e[31m⨯ " . $text . "\e[0m";
            breakLine($breakLineAfter);
            break;
        case "explication": // Orange
            breakLine($breakLineBefore);
            echo "\e[33m" . $text . "\e[0m";
            breakLine($breakLineAfter);
            break;
        case "information": // Cyan
            breakLine($breakLineBefore);
            echo "\e[36m>> " . $text . "\e[0m";
            breakLine($breakLineAfter);
            break;
    }
}

/**
 * =====================================
  * ===== CHECKING 
 * =====================================
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
        if ($errors != 0) {
            // Display errors
            foreach ($listErrors as $msgError) {
                displayText($msgError, "error", 0 ,1);
            }

            // Then, ask again the question
            breakLine(1);
            return readLine2($question, $rules);
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
 * =====================================
  * ===== MISC
 * =====================================
 */

/**
 * Check on Github if an update is available
 */

function checkUpdate() {
    if (CHECKUPDATE) {
        // Define URL
        $url = "https://gist.githubusercontent.com/n-deleforge/b82925d85cb7a1c92ede12091bea2173/raw/fbe2cf1c87fc74130619e52a23661932142eab36/fmt_version.txt";

        // Check the content and compare with the current version
        $updateFile = fopen($url, "r");
        $lastVersion = stream_get_contents($updateFile);
        if ($lastVersion != VERSION) {
            return displayText(LANG["menuInfoUpdate"], "success");
        }
    }

    // In any others cases, display current version
    return displayText(LANG["menuInfoVersion"] . " : " . VERSION, "normal-text");
}

/**
 * Generate a random value
 */

function randomValue() {
    $random = random_bytes(16);
    assert(strlen($random) == 16);
    return vsprintf('%s%s%s%s%s%s', str_split(bin2hex($random), 4));
}
