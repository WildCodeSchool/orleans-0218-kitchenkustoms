<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 25/04/18
 * Time: 10:57
 */

namespace Model;


/**
 * Class UplodedFile
 * @package Model
 */
class UplodedFile
{
    const WHITE_LIST = ['../assets/images/bikes/', '../assets/pdf/'];

    /**
     * @var array
     */
    private $file;
    /**
     * @var string
     */
    private $destination;
    /**
     * @var string
     */
    private $newName;

    /**
     * @var array
     */
    private $errors;

    /**
     * UplodedFile constructor.
     * @param array $file
     * @param string $destination
     * @param string $newName
     */
    public function __construct(array $file, string $destination, string $newName = null)
    {
        $this->setFile($file);
        $this->setDestination($destination);
        $this->setNewName($newName);
    }

    /**
     * @return null|string
     */
    private function check(): bool
    {
        if ($this->file['error'] !== 0) {
            $this->errors[] = 'Le fichier n\' a pas été déplacé.';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function move() : bool
    {
        return move_uploaded_file($this->file['tmp_name'], $this->destination . $this->newName);
    }


    public function process(): bool
    {
        $checked = $this->check();
        if ($checked) {
            $moved = $this->move();
            if ($moved) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * @param array $file
     * @return UplodedFile
     */
    public function setFile(array $file): UplodedFile
    {
        if ($file['name'] === '') {
            throw new \LogicException('Le nom du fichier ne peut pas être vide.');
        }

        if ($file['tmp_name'] === '') {
            throw new \LogicException('Le nom temporaire de fichier ne peut pas être vide.');
        }

        if ($file['error'] !== 0) {
            throw new \LogicException('Une erreur s\' est produite pendant l\' upload.');
        }

        $this->file = $file;
        return $this;
    }

    /**
     * @param string $destination
     * @return UplodedFile
     */
    public function setDestination(string $destination): UplodedFile
    {
        if (!is_dir($destination)) {
            throw new \LogicException('Le dossier de destination n\' existe pas.');
        }

        if (!in_array($destination, self::WHITE_LIST)) {
            throw new \LogicException('Le dossier de destination n\' est pas authorisé.');
        }

        $this->destination = $destination;
        return $this;
    }

    /**
     * @param string $newName
     * @return UplodedFile
     */
    public function setNewName(string $newName): UplodedFile
    {
        if ($newName === null) {
            $newName = $this->file['name'];
        }

        $this->newName = $newName;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}