<?php
/**
 * Created by JetBrains PhpStorm.
 * User: darko
 * Date: 12.04.13
 * Time: 10:50
 * To change this template use File | Settings | File Templates.
 */

namespace W3Scout\DompdfBundle;

use Dompdf\Dompdf;

class ContaoDOMPDF extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
}