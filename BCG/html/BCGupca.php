<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGupca');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Codé comme EAN-13.</li>
        <li>Le plus commun et bien connu aux États-Unis.</li>
        <li>Il y a 1 système de numéro (NS), 5 code du fabricant, 5 code du produit et 1 chiffre de contrôle. </li>
        <li>
            NS Description :
            <br />0 = Code UPC régulier
            <br />2 = Articles de poids
            <br />3 = Médicaments/Articles de santé
            <br />4 = Utilisation en magasin sur des articles non alimentaires
            <br />5 = Coupons
            <br />7 = Code UPC régulier
            <br />Et d’autres sont réservés.
        </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>