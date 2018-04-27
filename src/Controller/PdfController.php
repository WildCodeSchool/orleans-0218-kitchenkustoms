<?php

namespace Controller;

use Model\UplodedFile;

class PdfController extends AbstractController
{
    /**
     * @var array
     */
    private $form_pdf_error = [];

    public function adminUpdatePdf()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/uploadPdf.html.twig', []);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdfPage = array_keys($_FILES)[0];

            try {
                $pdf = new UplodedFile($_FILES[$pdfPage], '../assets/pdf/', 'tarifs-'. $pdfPage . '.pdf');
                $uploaded = $pdf->process('application/pdf');
            } catch (\Exception $e) {
                $uploaded = false;
                $pdf = null;
                $this->form_pdf_error[] = $e->getMessage();
            }

            if ($uploaded) {
                return $this->twig->render('Admin/uploadPdf.html.twig', [
                    'success' => true,
                ]);
            } else {
                if ($pdf === null) {
                    return $this->twig->render('Admin/uploadPdf.html.twig', [
                        'pdfErrors' => $this->form_pdf_error,
                    ]);
                }
                return $this->twig->render('Admin/uploadPdf.html.twig', [
                    'pdfErrors' => $this->form_pdf_error,
                    'errors' => $pdf->getErrors(),
                ]);
            }
        }
    }
}
