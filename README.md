# Contao DOMPDF Bundle

[![Latest Stable Version](https://poser.pugx.org/w3scout/contao-dompdf-bundle/v/stable)](https://packagist.org/packages/w3scout/contao-dompdf-bundle) [![Total Downloads](https://poser.pugx.org/w3scout/contao-dompdf-bundle/downloads)](https://packagist.org/packages/w3scout/contao-dompdf-bundle) [![Latest Unstable Version](https://poser.pugx.org/w3scout/contao-dompdf-bundle/v/unstable)](https://packagist.org/packages/w3scout/contao-dompdf-bundle) [![License](https://poser.pugx.org/w3scout/contao-dompdf-bundle/license)](https://packagist.org/packages/w3scout/contao-dompdf-bundle)

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
```sh
composer require w3scout/contao-dompdf-bundle
```
