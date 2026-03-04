<?php
define('IN_CB', true);
include('include/header.php');

$default_value['start'] = '';
$start = isset($_POST['start']) ? $_POST['start'] : $default_value['start'];
registerImageKey('start', $start);
registerImageKey('code', 'BCGcode128');

$vals = array();
for($i = 0; $i <= 127; $i++) {
    $vals[] = '%' . sprintf('%02X', $i);
}
$characters = array(
    'NUL', 'SOH', 'STX', 'ETX', 'EOT', 'ENQ', 'ACK', 'BEL', 'BS', 'TAB', 'LF', 'VT', 'FF', 'CR', 'SO', 'SI', 'DLE', 'DC1', 'DC2', 'DC3', 'DC4', 'NAK', 'SYN', 'ETB', 'CAN', 'EM', 'SUB', 'ESC', 'FS', 'GS', 'RS', 'US',
    '&nbsp;', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '*', '+', ',', '-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '<', '=', '>', '?',
    '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', '\\', ']', '^', '_',
    '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~', 'DEL'
);
?>

<ul id="specificOptions">
    <li class="option">
        <div class="title">
            <label for="start">Commence par</label>
        </div>
        <div class="value">
            <?php echo getSelectHtml('start', $start, array('NULL' => 'Auto', 'A' => 'Code 128-A', 'B' => 'Code 128-B', 'C' => 'Code 128-C')); ?>
        </div>
    </li>
</ul>

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php $c = count($characters); for ($i = 0; $i < $c; $i++) { echo getButton($characters[$i], $vals[$i]); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Le code 128 est une symbologie alphanumérique à haute densité. </li>
        <li>Utilisé largement dans le monde entier. </li>
        <li>Le code 128 est conçu pour encoder 128 caractères ASCII complets. </li>
        <li>La symbologie inclut un chiffre de somme de contrôle. </li>
        <li>Le code 128A gère les lettres majuscules<br />Le code 128B gère les lettres majuscules et minuscules<br />Le code 128C gère un groupe de 2 chiffres</li>
        <li>Votre navigateur peut ne pas être capable d’écrire les caractères spéciaux (NUL, SOH, etc.) mais vous pouvez les écrire avec le code. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>