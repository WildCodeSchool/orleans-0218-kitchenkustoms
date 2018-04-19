<?php

namespace Controller;

use Controller\AbstractController;
use Model\Bike;
use Model\BikeManager;
use PHP_CodeSniffer\Tokenizers\PHP;

/**
 * Class BikeController
 *
 */
class BikeController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bike()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();

        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
        ]);
    }

    public function bikeAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bikeName = $_POST['name'];
            $bikeDescription = $_POST['description'];

            $newBike = new Bike();
            $newBike->setName($bikeName);
            $newBike->setDescription($bikeDescription);

            $bikeManager = new BikeManager();
            try {
                $bikeManager->addBike($newBike);
            } catch (\LogicException $e) {
                $_SESSION['error_add'] = 'Le vélo n\'a pas été ajouté.';
                header('Location: /admin/add');
            }


            header('Location: /admin/bike');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/addBike.html.twig', []);
        }
    }

    public function bikeUpdate(int $id)
    {
        $bikeManager = new BikeManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = '../assets/images/bikes/';

            foreach ($_FILES as $photo => $details) {
                if ($details['error'] === 0) {
                    $newPath = $id;

                    if ($photo === 'photo_before') {
                        $newPath .= '_before.';
                    } elseif ($photo === 'photo_after') {
                        $newPath .= '_after.';
                    }

                    $fileInfo = new \SplFileInfo($details['name']);
                    $extension = $fileInfo->getExtension();
                    $newPath .= $extension;
                    $newImagePath = $imagePath . $newPath;

                    move_uploaded_file($details['tmp_name'], $newImagePath);

                    if ($photo === 'photo_before') {
                        $path = substr($newImagePath, 2, mb_strlen($newImagePath)-2);
                        $_POST['photo_before'] = $path;
                    } elseif ($photo === 'photo_after') {
                        $path = substr($newImagePath, 2, mb_strlen($newImagePath)-2);
                        $_POST['photo_after'] = $path;
                    }
                }
            }

            $bike = Bike::hydrate($_POST);
            $bikeManager->updateBike($bike);

            header('Location: /admin/bike');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $bike = $bikeManager->selectOneById($id);

            return $this->twig->render('Admin/updateBike.html.twig', [
                'bike' => $bike,
            ]);
        }
    }
}
