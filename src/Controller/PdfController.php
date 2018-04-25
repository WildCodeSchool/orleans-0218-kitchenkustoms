<?php

namespace Controller;

use Model\Pdf;

class PdfController extends AbstractController
{
    /**
     * @var array
     */
    private $form_pdf_error;

    public function adminUpdatePdf()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/uploadPdf.html.twig', []);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdf = new Pdf();
            $this->form_pdf_error = $pdf->updatePdf($_FILES, 'atelier');

            if ($this->form_pdf_error === null) {
                $success = true;

                return $this->twig->render('Admin/uploadPdf.html.twig', [
                    'success' => $success,
                ]);
            }

            return $this->twig->render('Admin/uploadPdf.html.twig', [
                'pdfError' => $this->form_pdf_error,
            ]);
        }
    }
}
