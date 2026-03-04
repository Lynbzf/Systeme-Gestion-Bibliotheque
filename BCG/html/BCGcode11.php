<?php
define('IN_CB', true);
include('include/header.php');

/* Enregistrement de la clé de l'image pour le code-barres Code 11 */
registerImageKey('code', 'BCGcode11');

/* Liste des caractères valides pour le Code 11 */
$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Également connu sous le nom USD-8.</li>
        <li>Le Code 11 a été développé en 1977 comme une symbologie numérique à haute densité.</li>
        <li>Utilisé pour identifier les équipements de télécommunications.</li>
        <li>Le Code 11 est une symbologie numérique et son jeu de caractères est composé de 10 chiffres et du symbole tiret (-).</li>
        <li>Il existe un chiffre de contrôle « C ». Si la longueur du message encodé est supérieure à 10, un chiffre de contrôle « K » peut être utilisé.</li>
    </ul>
</div>

<?php
include('include/footer.php');
?>
