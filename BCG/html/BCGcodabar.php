<?php
define('IN_CB', true);
include('include/header.php');

/* Enregistrement de la clé de l'image pour le code-barres Codabar */
registerImageKey('code', 'BCGcodabar');

/* Liste des caractères valides pour le Codabar */
$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', '$', ':', '/', '.', '+', 'A', 'B', 'C', 'D');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Également connu sous les noms Ames Code, NW-7, Monarch, 2 sur 7, Codabar rationalisé.</li>
        <li>Le Codabar a été développé en 1972 par Pitney Bowes, Inc.</li>
        <li>Cette symbologie est utilisée pour encoder des informations numériques. C’est un code auto-vérifiant, il n’y a pas de chiffre de contrôle.</li>
        <li>Le Codabar est utilisé par les banques de sang, les laboratoires photo, les bibliothèques, FedEx…</li>
        <li>Le codage peut avoir une longueur non spécifiée composée de chiffres, des signes plus et moins, deux-points, barre oblique, point et dollar.</li>
    </ul>
</div>

<?php
include('include/footer.php');
?>
