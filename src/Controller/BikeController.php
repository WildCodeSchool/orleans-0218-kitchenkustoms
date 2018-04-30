<?php

namespace Controller;

use Model\Bike;
use Model\BikeManager;
use Validation\BikeValidator;

/**
 * Class BikeController
 *
 */
class BikeController extends AbstractController
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeAdmin()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();
        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
            'get' => $_GET,
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeKustoms()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAllKustoms();
        return $this->twig->render('Home/kustom.html.twig', [
            'bikes' => $bikes,
        ]);
    }

   
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeShop()
    {
        $defaultPics = "assets/images/bikes/default.png";

        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAllShop();
        return $this->twig->render('Home/shop.html.twig', [
            'bikes' => $bikes,
            'default_bike' => $defaultPics,
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/addBike.html.twig', []);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new BikeValidator([
                'name' => $_POST['name'],
                'description' => $_POST['description']
            ]);

            if ($validator->isValid()) {
                $newBike = new Bike();
                $newBike->hydrate($_POST);
                $bikeManager = new BikeManager();
                $bikeManager->addBike($newBike);

                return $this->bikeAdmin();
            }
        }
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeUpdate(int $id)
    {
        $bikeManager = new BikeManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new BikeValidator([
                'name' => $_POST['name'],
                'description' => $_POST['description']
            ]);

            if ($validator->isValid()) {
                $bike = new Bike();
                $bike->checkPhotos($_POST['id']);
                $bike->hydrate($_POST);
                $bikeManager->updateBike($bike);

                header('Location: /admin/bike');
                exit();
            } else {
                $this->errors = $validator->getErrors();
                $bike = $bikeManager->selectOneById($id);

                return $this->twig->render('Admin/updateBike.html.twig', [
                    'errors' => $this->errors,
                    'bike' => $bike
                ]);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
                $bike = $bikeManager->selectOneById($_GET['id']);
            } else {
                $bike = $bikeManager->selectOneById($id);
            }

            return $this->twig->render('Admin/updateBike.html.twig', [
                'bike' => $bike,
            ]);
        }
    }

    /**
     * @param int $id
     */
    public function bikeDelete(int $id)
    {
        $bikeManager = new BikeManager();

        $deleted = $bikeManager->delete($id);

        if ($deleted) {
            $get = '?deleted=true&id=' . $id;
        } else {
            $get = '?deleted=false&id=' . $id;
        }

        header('Location: /admin/bike' . $get);
        exit();
    }
}
