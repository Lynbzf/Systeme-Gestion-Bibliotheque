<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGean8');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>EAN-8 est une version courte d’EAN-13.</li>
        <li>Composé de 7 chiffres et 1 chiffre de contrôle. </li>
        <li>Il n’y a pas de conversion disponible entre EAN-8 et EAN-13.</li>
    </ul>
</div>

<?php
include('include/footer.php');
?>