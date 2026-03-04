<?php
define('IN_CB', true);
include('include/header.php');

/* Valeur par défaut pour le checksum */
$default_value['checksum'] = '';
$checksum = isset($_POST['checksum']) ? $_POST['checksum'] : $default_value['checksum'];

/* Enregistrement des clés pour l'image du code-barres */
registerImageKey('checksum', $checksum);
registerImageKey('code', 'BCGcode39');

/* Liste des caractères valides pour le Code 39 */
$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
                    'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
                    'U', 'V', 'W', 'X', 'Y', 'Z', '-', '.', '&nbsp;', 
                    '$', '/', '+', '%');
?>

<ul id="specificOptions">
    <li class="option">
        <div class="title">
            <label for="checksum">Checksum</label>
        </div>
        <div class="value">
            <?php echo getCheckboxHtml('checksum', $checksum, array('value' => 1)); ?>
        </div>
    </li>
</ul>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Également connu sous le nom USS Code 39 ou 3 de 9.</li>
        <li>Le Code 39 peut encoder des caractères alphanumériques.</li>
        <li>Cette symbologie est utilisée dans des environnements non commerciaux.</li>
        <li>Le Code 39 encode 26 lettres majuscules, 10 chiffres et 7 caractères spéciaux.</li>
        <li>Le Code 39 possède un chiffre de contrôle (checksum), mais il est rarement utilisé.</li>
    </ul>
</div>

<?php
include('include/footer.php');
?>
