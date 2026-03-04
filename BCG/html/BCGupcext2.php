<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGupcext2');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Extension pour UPC-A, UPC-E, EAN-13 et EAN-8.</li>
        <li>Utilisé pour encoder des informations supplémentaires pour le journal, les livres...</li>
    </ul>
</div>

<?php
include('include/footer.php');
?>