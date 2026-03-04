<?php
define('IN_CB', true);
include('include/header.php');

registerImageKey('code', 'BCGcode93');

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

<div id="validCharacters">
    <h3>Caractères Valides</h3>
    <?php $c = count($characters); for ($i = 0; $i < $c; $i++) { echo getButton($characters[$i], $vals[$i]); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Connu aussi sous le nom de USS Code 93. </li>
        <li>Le Code 93 a été conçu pour fournir une densité plus élevée et une amélioration de la sécurité des données au Code 39.</li>
        <li>Utilisé principalement par le bureau de poste canadien pour encoder des informations supplémentaires sur la livraison. </li>
        <li>Similaire au Code 39, le Code 93 a les mêmes 43 caractères plus 5 spéciaux pour encoder l’ASCII 0 à 127. </li>
        <li>Cette symbologie composée de 2 chiffres de contrôle ("C" et "K"). </li>
        <li>Votre navigateur peut ne pas être capable d’écrire les caractères spéciaux (NUL, SOH, etc.) mais vous pouvez les écrire avec le code. </li>
    </ul>
</div>

<?php
include('include/footer.php');
?>