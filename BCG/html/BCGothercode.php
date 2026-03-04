<?php
define('IN_CB', true);
include('include/header.php');

$default_value['label'] = '';
$label = isset($_POST['label']) ? $_POST['label'] : $default_value['label'];
registerImageKey('label', $label);
registerImageKey('code', 'BCGothercode');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<ul id="specificOptions">
    <li class="option">
        <div class="title">
            <label for="label">Label</label>
        </div>
        <div class="value">
            <?php echo getInputTextHtml('label', $label); ?>
        </div>
    </li>
</ul>

<div id="validCharacters">
    <h3>Caractères Autorisés</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Entrez la largeur de chaque barre avec un caractère. Commencez par une barre.
        <li>10523 : Fera une barre de 2px, un espace de 1px, une barre de 6px, un espace de 3px, une barre de 4px. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>
