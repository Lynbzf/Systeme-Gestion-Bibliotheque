<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGpostnet');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
?>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php foreach ($characters as $character) { echo getButton($character); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Utilisé pour encoder l’enveloppe aux États-Unis.</li>
        <li>
            Vous pouvez fournir
            <br />5 chiffres (Code ZIP)
            <br />9 chiffres (code ZIP+4)
            <br />11 chiffres (ZIP+4 code+2 chiffres)
            <br />(Ces 2 chiffres sont tirés de votre adresse. Si votre adresse est 6453, le code sera 53.)
        </li>
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