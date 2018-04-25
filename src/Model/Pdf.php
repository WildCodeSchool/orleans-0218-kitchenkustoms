<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 25/04/18
 * Time: 10:57
 */

namespace Model;


class Pdf
{
    public function updatePdf($file,string $destination)
    {
        $file = $file['pdf'];

        if ($file['error'] !== 0) {
            return 'Le fichier n\' a pas été modifié.';
        }

        move_uploaded_file($file['tmp_name'], '../assets/pdf/tarifs-' . $destination . '.pdf');

        return null;
    }
}