CLS
@ECHO OFF

:: Get the path of the file
SET PATH_SCRIPT=%~dp0

:: Call the main script
PHP "%PATH_SCRIPT%files-multi-tools.php"