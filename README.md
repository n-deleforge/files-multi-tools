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

- Bulk file operations :
    - List all files.
    - Random renaming all files.
    - Modify all file extensions.
- Specific file operations :
    - Compare two files.
    - Compare one file with MD5 hash.
    - Compare one file with SHA1 hash.

# Quick start
## Disclaimer
This script has only been tested on a Windows PC.  
I am not responsible for any damage or problems occured from this script on your data. Always backup your data before anything.

## Installation and usage

PHP >7.2 must be installed on your computer.

```
git clone https://github.com/n-deleforge/files-multi-tools.git
cd files-multi-tools
fmt
```

## Launch from terminal

- Edit the PATH global variable and add the directory of files-multi-tools.
- Type "fmt" in your terminal to check if it's works.

# Changelog

- 0.2.3 : New scripts to check MD5/SHA1 hash with one file, some rewriting, linux bash script added.
- 0.2.2 : EXCLUDED constant added (avoid taking thumbs.db for Windows etc.).
- 0.2.1 : More messages, more informations, new script : modify extensions.
- 0.2 : Separation of the script in multiples files, new interface, more errors or informations messages.
- 0.1 : Initial release.
