# Contao DOMPDF Bundle

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/bfae05b3e99f4dd3ae04192cb603b7b4)](https://app.codacy.com/app/w3scout/contao-dompdf-bundle?utm_source=github.com&utm_medium=referral&utm_content=w3scout/contao-dompdf-bundle&utm_campaign=badger)
[![Latest Stable Version](https://poser.pugx.org/w3scout/contao-dompdf-bundle/v/stable)](https://packagist.org/packages/w3scout/contao-dompdf-bundle)
[![Total Downloads](https://poser.pugx.org/w3scout/contao-dompdf-bundle/downloads)](https://packagist.org/packages/w3scout/contao-dompdf-bundle)
[![Latest Unstable Version](https://poser.pugx.org/w3scout/contao-dompdf-bundle/v/unstable)](https://packagist.org/packages/w3scout/contao-dompdf-bundle)
[![License](https://poser.pugx.org/w3scout/contao-dompdf-bundle/license)](https://packagist.org/packages/w3scout/contao-dompdf-bundle)
[![Dependency Status](https://www.versioneye.com/user/projects/59efd6a60fb24f108275853a/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/59efd6a60fb24f108275853a)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/46c89e84-7ad0-498c-a8f7-999c7b5d03cb/mini.png)](https://insight.sensiolabs.com/projects/46c89e84-7ad0-498c-a8f7-999c7b5d03cb)

## About
Use [DOMPDF](https://github.com/dompdf/dompdf) to export articles as PDF.  
DOMPDF is slower than TCPDF but provides better CSS support.

## Requirements
 * PHP version >= 5.6.0
 * DOM extension
 * GD extension
 * MBString extension
 * php-font-lib
 * php-svg-lib

## Recommendations
 * OPcache (OPcache, XCache, APC, etc.): improves performance
 * IMagick or GMagick extension: improves image processing performance

## More information on Dompdf
* [Fonts and Character Encoding](https://github.com/dompdf/dompdf/wiki/About-Fonts-and-Character-Encoding)
* [CSS Compatibility](https://github.com/dompdf/dompdf/wiki/CSSCompatibility)

## Installation
Install [composer](https://getcomposer.org) if you haven't already, then enter this command in the main directory of your Contao installation:
```sh
composer require w3scout/contao-dompdf-bundle
```

## Usage
* Login to the backend and enable Dompdf at the system settings.
* Go to the themes section of the backend and create a stylesheet (@media print) to style the PDF output
