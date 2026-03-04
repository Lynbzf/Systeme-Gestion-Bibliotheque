<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGisbn');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>ISBN signifie Numéro International Standard du Livre.</li>
        <li>Le type d’ISBN est basé sur l’EAN-13.</li>
        <li>Auparavant, tous les ISBN étaient au format EAN-10. L’EAN-13 utilise le même encodage mais peut contenir des données différentes dans le numéro ISBN.
        <li>Composé d’un préfixe GS1 (pour ISBN-13), d’un identifiant de groupe, d’un code éditeur, d’un numéro d’article et d’un chiffre de contrôle. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>