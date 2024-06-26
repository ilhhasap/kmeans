<?php

namespace App\Services;

use Mpdf\Mpdf;

class PDFService
{
    public function generatePDF($view, $data = [])
    {
        $html = view($view, $data)->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('', 'S'); // Output as a string
    }
}
