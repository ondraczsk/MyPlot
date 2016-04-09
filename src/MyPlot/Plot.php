<?php
namespace MyPlot;

class Plot
{
    public $levelName, $X, $Z, $name, $owner, $helpers, $biome, $id, $plotPrivate, $open;

    /**
     * @param string $levelName
     * @param int $X
     * @param int $Z
     * @param string $name
     * @param string $owner
     * @param array $helpers
     * @param string $biome
     * @param int $id
     * @param bool $plotPrivate
     * @param bool $open
     */
    public function __construct($levelName, $X, $Z, $name = "", $owner = "", $helpers = [], $biome = "PLAINS", $id = -1, $plotPrivate = "False", $open = "False") {
        $this->levelName = $levelName;
        $this->X = $X;
        $this->Z = $Z;
        $this->name = $name;
        $this->owner = $owner;
        $this->helpers = $helpers;
        $this->biome = $biome;
        $this->id = $id;
        $this->plotPrivate = $plotPrivate;
        $this->open = $open;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function isHelper($username) {
        return in_array($username, $this->helpers);
    }

    /**
     * @param string $username
     * @return bool
     */
    public function addHelper($username) {
        if (!$this->isHelper($username)) {
            $this->helpers[] = $username;
            return true;
        }
        return false;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function removeHelper($username) {
        $key = array_search($username, $this->helpers);
        if ($key === false) {
            return false;
        }
        unset($this->helpers[$key]);
        return true;
    }

    public function __toString() {
        return "(" . $this->X . ";" . $this->Z . ")";
    }
    /**
     * @param bool $plotPrivate
     * @return bool
     */
    public function isPrivate($plot) {
        if ($this->plotPrivate(($plot) == "True") {
            return true;
        }
        return false;
    }
    
    /**
     * @param bool $open
     * @return bool
     */
    public function isOpen($plot) {
        if ($this->open(($plot) == "True") {
            return true;
        }
        return false;
    }
}
