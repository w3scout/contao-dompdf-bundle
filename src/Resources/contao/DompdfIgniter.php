<?php

/**
 * This file is part of w3scout/contao-dompdf-bundle.
 *
 * (c) 2017-2020 w3scout.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    w3scout/contao-dompdf-bundle
 * @author     Darko Selesi <http://w3scouts.com>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2017-2020 w3scout.
 * @license    https://github.com/w3scout/contao-dompdf-bundle/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace W3Scout\DompdfBundle;

use Contao\Environment;
use Contao\Idna;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Class DompdfIgniter
 */
class DompdfIgniter extends \Frontend
{
    /**
     * Export an article to PDF
     *
     * @param string
     * @param object
     *
     * @return string
     */
    public function generatePdf($strArticle, $objArticle)
    {
        if (!$GLOBALS['TL_CONFIG']['useDompdf']) {
            return;
        }

        // Add head section
        $strHtml =
            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
            . "\n";
        $strHtml .= '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
        $strHtml .= '<head>' . "\n";
        $strHtml .= '<title>' . $objArticle->title . '</title>' . "\n";
        $strHtml .= '<meta http-equiv="Content-Type" content="text/html; charset='
                    . $GLOBALS['TL_CONFIG']['characterSet'] . '" />' . "\n";

        // Add stylesheets
        $objStylesheet = $this->Database->execute("SELECT * FROM tl_style_sheet");
        while ($objStylesheet->next()) {
            $arrMedia = deserialize($objStylesheet->media, true);
            if (in_array('print', $arrMedia)) {
                $objResult = $this->Database->prepare('SELECT * FROM tl_style WHERE pid=? && invisible!=?')->execute(
                    $objStylesheet->id,
                    1
                );
                if ($objResult) {
                    $strStyles = '';
                    $arrStyles = $objResult->fetchAllAssoc();
                    if (is_array($arrStyles) && !empty($arrStyles)) {
                        foreach ($arrStyles as $s) {
                            $Stylesheet = new \StyleSheets();
                            $strStyles  .= $Stylesheet->compileDefinition($s, false, [], [], true);
                        }
                    }
                }
            }
        }

        // URL decode image paths (see #6411)
        $strArticle = preg_replace_callback(
            '@(src="[^"]+")@',
            function ($arg) {
                return rawurldecode($arg[0]);
            },
            $strArticle
        );

        // Handle line breaks in preformatted text
        $strArticle = preg_replace_callback(
            '@(<pre.*</pre>)@Us',
            function ($arg) {
                return str_replace("\n", '<br>', $arg[0]);
            },
            $strArticle
        );

        // Convert the Euro symbol
        $strArticle = str_replace('€', '&#8364;', $strArticle);

        // Make sure there is no background
        $strHtml .= '<style type="text/css">' . "\n";
        $strHtml .= 'body { background:none; background-color:#ffffff; }' . "\n";
        if (isset($strStyles) && !empty($strStyles)) {
            $strHtml .= $strStyles;
        }
        $strHtml .= '</style>' . "\n";
        $strHtml .= '</head>' . "\n";
        $strHtml .= '<body>' . "\n";
        $strHtml .= $strArticle . "\n";
        $strHtml .= '</body>' . "\n";
        $strHtml .= '</html>';
        $strHtml = str_replace(
            'src="files',
            'src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/files',
            $strHtml
        );

        // Generate DOMPDF object
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($strHtml);
        $dompdf->render();

        $dompdf->stream(standardize(ampersand($objArticle->title, false)));

        // Stop script execution
        exit;
    }
}
