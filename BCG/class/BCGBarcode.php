<?php
/**
 *--------------------------------------------------------------------
 *
 * Classe de base pour les codes-barres 1D et 2D
 *
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
include_once('BCGColor.php');
include_once('BCGLabel.php');
include_once('BCGArgumentException.php');
include_once('BCGDrawException.php');

abstract class BCGBarcode {
    const COLOR_BG = 0;
    const COLOR_FG = 1;

    protected $colorFg, $colorBg;       // Couleur de premier plan, couleur d’arrière-plan
    protected $scale;                   // Échelle du graphique, par défaut : 1
    protected $offsetX, $offsetY;       // Position de départ du dessin
    protected $labels = array();        // Tableau de BCGLabel
    protected $pushLabel = array(0, 0); // Décalage du label : gauche et haut

    /**
     * Constructeur.
     */
    protected function __construct() {
        $this->setOffsetX(0);
        $this->setOffsetY(0);
        $this->setForegroundColor(0x000000);
        $this->setBackgroundColor(0xffffff);
        $this->setScale(1);
    }

    /**
     * Analyse le texte avant son affichage.
     *
     * @param mixed $text
     */
    public function parse($text) {
    }

    /**
     * Récupère la couleur de premier plan du code-barres.
     *
     * @return BCGColor
     */
    public function getForegroundColor() {
        return $this->colorFg;
    }

    /**
     * Définit la couleur de premier plan du code-barres.
     * Peut être un objet BCGColor, un nom de couleur (white, black, yellow…)
     * ou une valeur hexadécimale.
     *
     * @param mixed $code
     */
    public function setForegroundColor($code) {
        if ($code instanceof BCGColor) {
            $this->colorFg = $code;
        } else {
            $this->colorFg = new BCGColor($code);
        }
    }

    /**
     * Récupère la couleur d’arrière-plan du code-barres.
     *
     * @return BCGColor
     */
    public function getBackgroundColor() {
        return $this->colorBg;
    }

    /**
     * Définit la couleur d’arrière-plan du code-barres.
     * Peut être un objet BCGColor, un nom de couleur (white, black, yellow…)
     * ou une valeur hexadécimale.
     *
     * @param mixed $code
     */
    public function setBackgroundColor($code) {
        if ($code instanceof BCGColor) {
            $this->colorBg = $code;
        } else {
            $this->colorBg = new BCGColor($code);
        }

        foreach ($this->labels as $label) {
            $label->setBackgroundColor($this->colorBg);
        }
    }

    /**
     * Définit les couleurs.
     *
     * @param mixed $fg
     * @param mixed $bg
     */
    public function setColor($fg, $bg) {
        $this->setForegroundColor($fg);
        $this->setBackgroundColor($bg);
    }

    /**
     * Récupère l’échelle du code-barres.
     *
     * @return int
     */
    public function getScale() {
        return $this->scale;
    }

    /**
     * Définit l’échelle du code-barres en pixels.
     * Si l’échelle est inférieure à 1, une exception est levée.
     *
     * @param int $scale
     */
    public function setScale($scale) {
        $scale = intval($scale);
        if ($scale <= 0) {
            throw new BCGArgumentException('L’échelle doit être supérieure à 0.', 'scale');
        }

        $this->scale = $scale;
    }

    /**
     * Méthode abstraite qui dessine le code-barres sur la ressource.
     *
     * @param resource $im
     */
    public abstract function draw($im);

    /**
     * Retourne la taille maximale du code-barres.
     * [0] → largeur
     * [1] → hauteur
     *
     * @param int $w
     * @param int $h
     * @return int[]
     */
    public function getDimension($w, $h) {
        $labels = $this->getBiggestLabels(false);
        $pixelsAround = array(0, 0, 0, 0); // Haut, Droite, Bas, Gauche

        if (isset($labels[BCGLabel::POSITION_TOP])) {
            $dimension = $labels[BCGLabel::POSITION_TOP]->getDimension();
            $pixelsAround[0] += $dimension[1];
        }

        if (isset($labels[BCGLabel::POSITION_RIGHT])) {
            $dimension = $labels[BCGLabel::POSITION_RIGHT]->getDimension();
            $pixelsAround[1] += $dimension[0];
        }

        if (isset($labels[BCGLabel::POSITION_BOTTOM])) {
            $dimension = $labels[BCGLabel::POSITION_BOTTOM]->getDimension();
            $pixelsAround[2] += $dimension[1];
        }

        if (isset($labels[BCGLabel::POSITION_LEFT])) {
            $dimension = $labels[BCGLabel::POSITION_LEFT]->getDimension();
            $pixelsAround[3] += $dimension[0];
        }

        $finalW = ($w + $this->offsetX) * $this->scale;
        $finalH = ($h + $this->offsetY) * $this->scale;

        // Vérifie si un label haut/bas dépasse en largeur
        // ou si un label gauche/droite dépasse en hauteur
        $reversedLabels = $this->getBiggestLabels(true);
        foreach ($reversedLabels as $label) {
            $dimension = $label->getDimension();
            $alignment = $label->getAlignment();

            if ($label->getPosition() === BCGLabel::POSITION_LEFT || $label->getPosition() === BCGLabel::POSITION_RIGHT) {
                if ($alignment === BCGLabel::ALIGN_TOP) {
                    $pixelsAround[2] = max($pixelsAround[2], $dimension[1] - $finalH);
                } elseif ($alignment === BCGLabel::ALIGN_CENTER) {
                    $temp = ceil(($dimension[1] - $finalH) / 2);
                    $pixelsAround[0] = max($pixelsAround[0], $temp);
                    $pixelsAround[2] = max($pixelsAround[2], $temp);
                } elseif ($alignment === BCGLabel::ALIGN_BOTTOM) {
                    $pixelsAround[0] = max($pixelsAround[0], $dimension[1] - $finalH);
                }
            } else {
                if ($alignment === BCGLabel::ALIGN_LEFT) {
                    $pixelsAround[1] = max($pixelsAround[1], $dimension[0] - $finalW);
                } elseif ($alignment === BCGLabel::ALIGN_CENTER) {
                    $temp = ceil(($dimension[0] - $finalW) / 2);
                    $pixelsAround[1] = max($pixelsAround[1], $temp);
                    $pixelsAround[3] = max($pixelsAround[3], $temp);
                } elseif ($alignment === BCGLabel::ALIGN_RIGHT) {
                    $pixelsAround[3] = max($pixelsAround[3], $dimension[0] - $finalW);
                }
            }
        }

        $this->pushLabel[0] = $pixelsAround[3];
        $this->pushLabel[1] = $pixelsAround[0];

        $finalW = ($w + $this->offsetX) * $this->scale + $pixelsAround[1] + $pixelsAround[3];
        $finalH = ($h + $this->offsetY) * $this->scale + $pixelsAround[0] + $pixelsAround[2];

        return array($finalW, $finalH);
    }

    /**
     * Récupère le décalage X.
     *
     * @return int
     */
    public function getOffsetX() {
        return $this->offsetX;
    }

    /**
     * Définit le décalage X.
     *
     * @param int $offsetX
     */
    public function setOffsetX($offsetX) {
        $offsetX = intval($offsetX);
        if ($offsetX < 0) {
            throw new BCGArgumentException('Le décalage X doit être supérieur ou égal à 0.', 'offsetX');
        }

        $this->offsetX = $offsetX;
    }

    /**
     * Récupère le décalage Y.
     *
     * @return int
     */
    public function getOffsetY() {
        return $this->offsetY;
    }

    /**
     * Définit le décalage Y.
     *
     * @param int $offsetY
     */
    public function setOffsetY($offsetY) {
        $offsetY = intval($offsetY);
        if ($offsetY < 0) {
            throw new BCGArgumentException('Le décalage Y doit être supérieur ou égal à 0.', 'offsetY');
        }

        $this->offsetY = $offsetY;
    }

    /**
     * Ajoute un label au dessin.
     *
     * @param BCGLabel $label
     */
    public function addLabel(BCGLabel $label) {
        $label->setBackgroundColor($this->colorBg);
        $this->labels[] = $label;
    }

    /**
     * Supprime un label du dessin.
     *
     * @param BCGLabel $label
     */
    public function removeLabel(BCGLabel $label) {
        $remove = -1;
        $c = count($this->labels);

        for ($i = 0; $i < $c; $i++) {
            if ($this->labels[$i] === $label) {
                $remove = $i;
                break;
            }
        }

        if ($remove > -1) {
            array_splice($this->labels, $remove, 1);
        }
    }

    /**
     * Supprime tous les labels.
     */
    public function clearLabels() {
        $this->labels = array();
    }

    /**
     * Dessine le texte.
     * Les coordonnées représentent les positions du code-barres.
     * $x1 et $y1 → coin supérieur gauche
     * $x2 et $y2 → coin inférieur droit
     *
     * @param resource $im
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     */
    protected function drawText($im, $x1, $y1, $x2, $y2) {
        foreach ($this->labels as $label) {
            $label->draw(
                $im,
                ($x1 + $this->offsetX) * $this->scale + $this->pushLabel[0],
                ($y1 + $this->offsetY) * $this->scale + $this->p*
