<?php
define('IN_CB', true);
include('include/header.php');

$default_value['checksum'] = '';
$checksum = isset($_POST['checksum']) ? $_POST['checksum'] : $default_value['checksum'];
registerImageKey('checksum', $checksum);
registerImageKey('code', 'BCGi25');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
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
    <h3>caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Interleaved 2 of 5 est basé sur la symbologie Standard 2 of 5. </li>
        <li>Il y a un checksum facultatif. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>