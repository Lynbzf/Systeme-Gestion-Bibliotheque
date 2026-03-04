<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGupcext5');

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
        <li>Utilisé pour encoder le prix de détail suggéré. </li>
        <li>Si le premier nombre est un 0, le prix xx.xx est exprimé en livres sterling. S’il s’agit d’un 5, il est exprimé en dollars américains. </li>
        <li>
            Description du code spécial :
            <br />90000 : Pas de prix conseillé
            <br />99991 : L’article est un complément d’un autre. Normalement gratuit
            <br />99990 : Association nationale des magasins universitaires de bh pour marquer « livre d’occasion »
            <br />90001 à 98999 : Fins internes pour certains éditeurs
        </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>