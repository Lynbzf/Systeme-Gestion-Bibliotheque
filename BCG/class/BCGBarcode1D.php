<?php
/**
 *--------------------------------------------------------------------
 *
 * Contient tous les types de codes-barres pour la génération 1D
 *
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
include_once('BCGArgumentException.php');
include_once('BCGBarcode.php');
include_once('BCGFontPhp.php');
include_once('BCGFontFile.php');

abstract class BCGBarcode1D extends BCGBarcode {
    const SIZE_SPACING_FONT = 5;

    const AUTO_LABEL = '##!!AUTO_LABEL!!##';

    protected $thickness;       // int
    protected $keys, $code;     // string[]
    protected $positionX;       // int
    protected $textfont;        // BCGFont
    protected $text;            // string
    protected $checksumValue;   // int or int[]
    protected $displayChecksum; // bool
    protected $label;           // Label
    protected $defaultLabel;    // BCGLabel

    /**
     * Constructeur.
     */
    protected function __construct() {
        parent::__construct();

        $this->setThickness(30);

        $this->defaultLabel = new BCGLabel();
        $this->defaultLabel->setPosition(BCGLabel::POSITION_BOTTOM);
        $this->setLabel(self::AUTO_LABEL);
        $this->setFont(new BCGFontPhp(5));

        $this->text = '';
        $this->checksumValue = false;
    }

    /**
     * Obtient l’épaisseur.
     *
     * @return int
     */
    public function getThickness() {
        return $this->thickness;
    }

    /**
     * définit l'épaisseur.
     *
     * @param int $thickness
     */
    public function setThickness($thickness) {
        $this->thickness = intval($thickness);
        if ($this->thickness <= 0) {
            throw new BCGArgumentException('The thickness must be larger than 0.', 'thickness');
        }
    }

    /**
     * Obtient l’étiquette.
     * Si l’étiquette a été définie sur BCGBarcode1D::AUTO_LABEL, l’étiquette affichera la valeur du texte analysé.
     *
     * @return string
     */
    public function getLabel() {
        $label = $this->label;
        if ($this->label === self::AUTO_LABEL) {
            $label = $this->text;
            if ($this->displayChecksum === true && ($checksum = $this->processChecksum()) !== false) {
                $label .= $checksum;
            }
        }

        return $label;
    }

    /**
     * Définit l’étiquette.
     * Vous pouvez utiliser BCGBarcode::AUTO_LABEL pour que l’étiquette soit automatiquement écrite en fonction du texte analysé.
     *
     * @param string $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * Obtient la police
     *
     * @return BCGFont
     */
    public function getFont() {
        return $this->font;
    }

    /**
     * Défini la police.
     *
     * @param mixed $font BCGFont or int
     */
    public function setFont($font) {
        if (is_int($font)) {
            if ($font === 0) {
                $font = null;
            } else {
                $font = new BCGFontPhp($font);
            }
        }

        $this->font = $font;
    }

    /**
     * Analyse le texte avant de l’afficher.
     *
     * @param mixed $text
     */
    public function parse($text) {
        $this->text = $text;
        $this->checksumValue = false; // Reset checksumValue
        $this->validate();

        parent::parse($text);

        $this->addDefaultLabel();
    }

    /**
     * Obtient le total de contrôle d’un code-barres.
     * Si aucune somme de contrôle n’est disponible, retourner FALSE.
     *
     * @return string
     */
    public function getChecksum() {
        return $this->processChecksum();
    }

    /**
     * @param boolean $displayChecksum
     */
    public function setDisplayChecksum($displayChecksum) {
        $this->displayChecksum = (bool)$displayChecksum;
    }

    /**
     * Ajoute le label par défaut.
     */
    protected function addDefaultLabel() {
        $label = $this->getLabel();
        $font = $this->font;
        if ($label !== null && $label !== '' && $font !== null && $this->defaultLabel !== null) {
            $this->defaultLabel->setText($label);
            $this->defaultLabel->setFont($font);
            $this->addLabel($this->defaultLabel);
        }
    }

    /**
     * Valide l’entrée
     */
    protected function validate() {
        // Pas de validation dans la classe abstraite.
    }

    /**
     * Renvoie l’index dans $keys (utile pour le checksum).
     *
     * @param mixed $var
     * @return mixed
     */
    protected function findIndex($var) {
        return array_search($var, $this->keys);
    }

    /**
     * Retourne le code du char.
     *
     * @param mixed $var
     * @return string
     */
    protected function findCode($var) {
        return $this->code[$this->findIndex($var)];
    }

    /**
     * Dessine tous les caractères grâce à $code. si $start est vrai, la ligne commence par un espace.
     * si $start est faux, la ligne commence par une barre.
     *
     * @param resource $im
     * @param string $code
     * @param boolean $startBar
     */
    protected function drawChar($im, $code, $startBar = true) {
        $colors = array(BCGBarcode::COLOR_FG, BCGBarcode::COLOR_BG);
        $currentColor = $startBar ? 0 : 1;
        $c = strlen($code);
        for ($i = 0; $i < $c; $i++) {
            for ($j = 0; $j < intval($code[$i]) + 1; $j++) {
                $this->drawSingleBar($im, $colors[$currentColor]);
                $this->nextX();
            }

            $currentColor = ($currentColor + 1) % 2;
        }
    }

    /**
     * Dessine une barre de $color en fonction de la résolution.
     *
     * @param resource $img
     * @param int $color
     */
    protected function drawSingleBar($im, $color) {
        $this->drawFilledRectangle($im, $this->positionX, 0, $this->positionX, $this->thickness - 1, $color);
    }

    
    protected function nextX() {
        $this->positionX++;
    }

    /**
     * Méthode qui enregistre FALSE dans checksumValue. Cela signifie pas de checksum
     *
     */
    protected function calculateChecksum() {
        $this->checksumValue = false;
    }

    /**
     * Retourne FALSE car il n’y a pas de somme de contrôle. Cette méthode devrait être
     * surcharger pour retourner correctement la somme de contrôle dans la chaîne avec checksumValue.
     *
     * @return string
     */
    protected function processChecksum() {
        return false;
    }
}
?>