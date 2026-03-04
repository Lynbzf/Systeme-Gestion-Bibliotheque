<?php
define('IN_CB', true);
include('include/header.php');

/* Valeurs par défaut */
$default_value['barcodeIdentifier'] = '';
$barcodeIdentifier = isset($_POST['barcodeIdentifier']) ? $_POST['barcodeIdentifier'] : $default_value['barcodeIdentifier'];
registerImageKey('barcodeIdentifier', $barcodeIdentifier);

$default_value['serviceType'] = '';
$serviceType = isset($_POST['serviceType']) ? $_POST['serviceType'] : $default_value['serviceType'];
registerImageKey('serviceType', $serviceType);

$default_value['mailerIdentifier'] = '';
$mailerIdentifier = isset($_POST['mailerIdentifier']) ? $_POST['mailerIdentifier'] : $default_value['mailerIdentifier'];
registerImageKey('mailerIdentifier', $mailerIdentifier);

$default_value['serialNumber'] = '';
$serialNumber = isset($_POST['serialNumber']) ? $_POST['serialNumber'] : $default_value['serialNumber'];
registerImageKey('serialNumber', $serialNumber);

registerImageKey('code', 'BCGintelligentmail');

/* Caractères valides pour Intelligent Mail */
$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<ul id="specificOptions">
    <li class="option">
        <div class="title">
            <label for="barcodeIdentifier">Identifiant du code-barres</label>
        </div>
        <div class="value">
            <?php echo getInputTextHtml('barcodeIdentifier', $barcodeIdentifier, array('type' => 'text', 'maxlength' => 2, 'required' => 'required')); ?>
        </div>
    </li>
    <li class="option">
        <div class="title">
            <label for="serviceType">Type de service</label>
        </div>
        <div class="value">
            <?php echo getInputTextHtml('serviceType', $serviceType, array('type' => 'text', 'maxlength' => 3, 'required' => 'required')); ?>
        </div>
    </li>
    <li class="option">
        <div class="title">
            <label for="mailerIdentifier">Identifiant de l’expéditeur</label>
        </div>
        <div class="value">
            <?php echo getInputTextHtml('mailerIdentifier', $mailerIdentifier, array('type' => 'text', 'maxlength' => 9, 'required' => 'required')); ?>
        </div>
    </li>
    <li class="option">
        <div class="title">
            <label for="serialNumber">Numéro de série</label>
        </div>
        <div class="value">
            <?php echo getInputTextHtml('serialNumber', $serialNumber, array('type' => 'text', 'maxlength' => 9, 'required' => 'required')); ?>
        </div>
    </li>
</ul>

<div id="validCharacters">
    <h3>Caractères valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Utilisé pour encoder les enveloppes aux États-Unis.</li>
        <li>
            Vous pouvez fournir :
            <br />5 chiffres (code ZIP)
            <br />9 chiffres (code ZIP+4)
            <br />11 chiffres (ZIP+4 + 2 chiffres supplémentaires)
        </li>
        <li>Contient un identifiant de code-barres, un identifiant de type de service, un identifiant de l’expéditeur et un numéro de série.</li>
    </ul>
</div>

<script>
(function($) {
    "use strict";

    $(function() {
        var thickness = $("#thickness")
            .val(9)
            .removeAttr("min step")
            .prop("disabled", true);

        $("form").on("submit", function() {
            thickness.prop("disabled", false);
        });
    });
})(jQuery);
</script>

<?php
include('include/footer.php');
?>
