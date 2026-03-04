<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGupce');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Version courte du symbole UPC, 8 caractères. </li>
        <li>C’est une conversion d’un UPC-A pour petit paquet. </li>
        <li>Vous pouvez fournir directement un code UPC-A (11 caractères) ou UPC-E (6 caractères). </li>
        <li>UPC-E contiennent un numéro de système et un chiffre de contrôle. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>