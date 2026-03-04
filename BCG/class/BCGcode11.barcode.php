<?php
/**
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 11
 *
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
include_once('BCGParseException.php');
include_once('BCGBarcode1D.php');

class BCGcode11 extends BCGBarcode1D {
    /**
     * Constructeur.
     */
    public function __construct() {
        parent::__construct();

        $this->keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-');
        $this->code = array(    // 0 ajouté pour ajouter un espace en plus.
            '000010',   /* 0 */
            '100010',   /* 1 */
            '010010',   /* 2 */
            '110000',   /* 3 */
            '001010',   /* 4 */
            '101000',   /* 5 */
            '011000',   /* 6 */
            '000110',   /* 7 */
            '100100',   /* 8 */
            '100000',   /* 9 */
            '001000'    /* - */
        );
    }

    /**
     * Dessine le code-barres.
     *
     * @param resource $im
     */
    public function draw($im) {
        
        $this->drawChar($im, '001100', true);

        // Chars
        $c = strlen($this->text);
        for ($i = 0; $i < $c; $i++) {
            $this->drawChar($im, $this->findCode($this->text[$i]), true);
        }

        // Checksum
        $this->calculateChecksum();
        $c = count($this->checksumValue);
        for ($i = 0; $i < $c; $i++) {
            $this->drawChar($im, $this->code[$this->checksumValue[$i]], true);
        }

        
        $this->drawChar($im, '00110', true);
        $this->drawText($im, 0, 0, $this->positionX, $this->thickness);
    }

    /**
     * Retourne la taille maximale d'un code-barres
     *
     * @param int $w
     * @param int $h
     * @return int[]
     */
    public function getDimension($w, $h) {
        $textlength = 0;
        $c = strlen($this->text);
        for ($i = 0; $i < $c; $i++) {
            $index = $this->findIndex($this->text[$i]);
            if ($index !== false) {
                $textlength += 6;
                $textlength += substr_count($this->code[$index], '1');
            }
        }

        $startlength = 8;

        // On prend la longueure maximale possible pour checksums (c'est 7 ou 8...)
        $checksumlength = 8;
        if ($c >= 10) {
            $checksumlength += 8;
        }

        $endlength = 7 * $this->scale;

        $w += $startlength + $textlength + $checksumlength + $endlength;
        $h += $this->thickness;
        return parent::getDimension($w, $h);
    }

    /**
     * Valide l'entrée.
     */
    protected function validate() {
        $c = strlen($this->text);
        if ($c === 0) {
            throw new BCGParseException('code11', 'No data has been entered.');
        }

        // Check si tous les charactères sont autorisés
        for ($i = 0; $i < $c; $i++) {
            if (array_search($this->text[$i], $this->keys) === false) {
                throw new BCGParseException('code11', 'The character \'' . $this->text[$i] . '\' is not allowed.');
            }
        }

        parent::validate();
    }

    /**
     * Méthode surchargée pour calculer le checksum.
     */
    protected function calculateChecksum() {
        // Checksum
        // Premier CheckSUM "C"
        // Le caractère de somme de contrôle "C" est le reste modulo 11 de la somme du pondéré
        // valeur des caractères de données. La valeur de pondération commence à « 1 » pour le plus à droite
        // caractère de données, 2 pour l’avant-dernière, 3 pour l’avant-dernier, et ainsi de suite jusqu’à 20.
        // Après 10, la séquence s’enroule autour de 1.

        // Deuxième CheckSUM "K"
        // Pareil que CheckSUM "C" mais on compte le CheckSum "C" à la fin
        // Après 9, la séquence s’enroule autour de 1.
        $sequence_multiplier = array(10, 9);
        $temp_text = $this->text;
        $this->checksumValue = array();
        for ($z = 0; $z < 2; $z++) {
            $c = strlen($temp_text);

            if ($c <= 10 && $z === 1) {
                break;
            }

            $checksum = 0;
            for ($i = $c, $j = 0; $i > 0; $i--, $j++) {
                $multiplier = $i % $sequence_multiplier[$z];
                if ($multiplier === 0) {
                    $multiplier = $sequence_multiplier[$z];
                }

                $checksum += $this->findIndex($temp_text[$j]) * $multiplier;
            }

            $this->checksumValue[$z] = $checksum % 11;
            $temp_text .= $this->keys[$this->checksumValue[$z]];
        }
    }

    protected function processChecksum() {
        if ($this->checksumValue === false) { // Calculer le checksum une seule fois
            $this->calculateChecksum();
        }

        if ($this->checksumValue !== false) {
            $ret = '';
            $c = count($this->checksumValue);
            for ($i = 0; $i < $c; $i++) {
                $ret .= $this->keys[$this->checksumValue[$i]];
            }

            return $ret;
        }

        return false;
    }
}
?>