![Header](/docs/header.png)

<div align="center">

[![GitHub license](https://img.shields.io/github/license/n-deleforge/files-multi-tools?style=for-the-badge)](https://github.com/n-deleforge/files-multi-tools/blob/main/LICENCE)
![GitHub last commit](https://img.shields.io/github/last-commit/n-deleforge/files-multi-tools?style=for-the-badge)
[![GitHub forks](https://img.shields.io/github/forks/n-deleforge/files-multi-tools?style=for-the-badge)](https://github.com/n-deleforge/files-multi-tools/network)
[![GitHub stars](https://img.shields.io/github/stars/n-deleforge/files-multi-tools?style=for-the-badge)](https://github.com/n-deleforge/files-multi-tools/stargazers)
[![Paypal](https://img.shields.io/badge/DONATE-PAYPAL.ME-lightgrey?style=for-the-badge)](https://www.paypal.com/paypalme/nicolasdeleforge)

</div>

![Screenshot](/docs/screenshot.png)

# Features

- List all files from a directory in a text file (extension can be removed, a prefix can be added)
- Compare two files (with MD5 and SHA1 hash)
- Random renaming all files in a directory

# Quick start

## Disclaimer

This script has only been tested on a Windows PC.  
I am not responsible for any damage or problems occured from this script on your data. Always backup your data before anything.

## Requirements

PHP >7.2 must be installed on your computer.

## Installation

```
git clone https://github.com/n-deleforge/files-multi-tools.git`
cd files-multi-tools`
php files-multi-tools.php`
```

## Launch it with the terminal

- Create a file named `files-multi-tools.bat`
- Edit it with the following line : `php "path-to-the-directory/files-multi-tools.php"` (you have to modify the path according your configuration)
- Add the directory of the `files-multi-tools.bat` file in the PATH variable of your Windows
- Type "files-multi-tools" in your terminal to check if it's works

# Changelog

- 0.1 : Initial release
