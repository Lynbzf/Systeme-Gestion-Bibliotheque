<?php
define('IN_CB', true);
include('include/header.php');

/* Valeur par défaut pour le début du code */
$default_value['start'] = 'C';
$start = isset($_POST['start']) ? $_POST['start'] : $default_value['start'];
registerImageKey('start', $start);

/* Liste des identifiants pour GS1-128 */
$identifiers = array(
    ''    =>    'Sélectionner un identifiant',
    '00'    =>    'Code de conteneur série (SSCC-18)',
    '01'    =>    'Code conteneur (SSC)',
    '02'    =>    'Nombre de conteneurs',
    '10'    =>    'Numéro de lot',
    '11'    =>    'Date de production',
    '12'    =>    'Date d’échéance',
    '13'    =>    'Date d’emballage',
    '15'    =>    'Date limite de vente (Contrôle Qualité)',
    '17'    =>    'Date d’expiration',
    '20'    =>    'Variante de produit',
    '21'    =>    'Numéro de série',
    '240'    =>    'Identification supplémentaire du produit',
    '241'    =>    'Numéro de pièce client',
    '250'    =>    'Second numéro de série',
    '251'    =>    'Référence à l’entité source',
    '253'    =>    'Identifiant global du type de document',
    '30'    =>    'Quantité unitaire',
    '310y'    =>    'Poids net du produit en kg',
    '311y'    =>    'Longueur du produit / 1ère dimension, en mètres',
    '312y'    =>    'Largeur / diamètre / 2e dimension, en mètres',
    '313y'    =>    'Profondeur / épaisseur / 3e dimension, en mètres',
    '314y'    =>    'Surface du produit, en mètres carrés',
    '315y'    =>    'Volume du produit, en litres',
    '316y'    =>    'Volume du produit, en mètres cubes',
    '320y'    =>    'Poids net du produit, en livres',
    '321y'    =>    'Longueur du produit / 1ère dimension, en pouces',
    '322y'    =>    'Longueur du produit / 1ère dimension, en pieds',
    '323y'    =>    'Longueur du produit / 1ère dimension, en yards',
    '324y'    =>    'Largeur / diamètre / 2e dimension, en pouces',
    '325y'    =>    'Largeur / diamètre / 2e dimension, en pieds',
    '326y'    =>    'Largeur / diamètre / 2e dimension, en yards',
    '327y'    =>    'Profondeur / épaisseur / 3e dimension, en pouces',
    '328y'    =>    'Profondeur / épaisseur / 3e dimension, en pieds',
    '329y'    =>    'Profondeur / épaisseur / 3e dimension, en yards',
    '330y'    =>    'Poids brut du conteneur (Kg)',
    '331y'    =>    'Longueur du conteneur / 1ère dimension (Mètres)',
    '332y'    =>    'Largeur / diamètre / 2e dimension (Mètres)',
    '333y'    =>    'Profondeur / épaisseur / 3e dimension (Mètres)',
    '334y'    =>    'Surface du conteneur (Mètres carrés)',
    '335y'    =>    'Volume brut du conteneur (Litres)',
    '336y'    =>    'Volume brut du conteneur (Mètres cubes)',
    '337y'    =>    'Kg par mètre carré',
    '340y'    =>    'Poids brut du conteneur (Livres)',
    '341y'    =>    'Longueur du conteneur / 1ère dimension, en pouces',
    '342y'    =>    'Longueur du conteneur / 1ère dimension, en pieds',
    '343y'    =>    'Longueur du conteneur / 1ère dimension, en yards',
    '344y'    =>    'Largeur / diamètre / 2e dimension, en pouces',
    '345y'    =>    'Largeur / diamètre / 2e dimension, en pieds',
    '346y'    =>    'Largeur / diamètre / 2e dimension, en yards',
    '347y'    =>    'Profondeur / épaisseur / hauteur / 3e dimension, en pouces',
    '348y'    =>    'Profondeur / épaisseur / hauteur / 3e dimension, en pieds',
    '349y'    =>    'Profondeur / épaisseur / hauteur / 3e dimension, en yards',
    '350y'    =>    'Surface du produit (Pouces carrés)',
    '351y'    =>    'Surface du produit (Pieds carrés)',
    '352y'    =>    'Surface du produit (Yards carrés)',
    '353y'    =>    'Surface du conteneur (Pouces carrés)',
    '354y'    =>    'Surface du conteneur (Pieds carrés)',
    '355y'    =>    'Surface du conteneur (Yards carrés)',
    '356y'    =>    'Poids net (onces troy)',
    '357y'    =>    'Kg par mètre carré',
    '360y'    =>    'Volume du produit (Quarts)',
    '361y'    =>    'Volume du produit (Gallons)',
    '362y'    =>    'Volume brut du conteneur (Quarts)',
    '363y'    =>    'Volume brut du conteneur (Gallons)',
    '364y'    =>    'Volume du produit (Pouces cubes)',
    '365y'    =>    'Volume du produit (Pieds cubes)',
    '366y'    =>    'Volume du produit (Yards cubes)',
    '367y'    =>    'Volume brut du conteneur (Pouces cubes)',
    '368y'    =>    'Volume brut du conteneur (Pieds cubes)',
    '369y'    =>    'Volume brut du conteneur (Yards cubes)',
    '37'    =>    'Nombre d’unités contenues',
    '390y'    =>    'Montant à payer - unité monétaire unique',
    '391y'    =>    'Montant à payer avec code devise ISO',
    '392y'    =>    'Montant à payer pour un article à mesure variable - unité monétaire unique',
    '393y'    =>    'Montant à payer pour un article à mesure variable - avec code devise ISO',
    '400'    =>    'Numéro de commande client',
    '401'    =>    'Numéro d’expédition',
    '402'    =>    'Numéro d’identification de l’envoi',
    '403'    =>    'Code de routage',
    '410'    =>    'Code de livraison (EAN13 ou DUNS)',
    '411'    =>    'Code de facturation (EAN13 ou DUNS)',
    '412'    =>    'Code du lieu d’achat (EAN13 ou DUNS)',
    '413'    =>    'Livrer pour - code EAN.UCC Global Location Number',
    '414'    =>    'Identification d’un emplacement physique EAN.UCC Global Location Number',
    '415'    =>    'EAN.UCC Global Location Number de la partie facturante'
    '420' => 'Expédier/Livrer au code postal (autorité postale unique)',
    '421' => 'Expédier/Livrer au code postal (autorité postale multiple)',
    '422' => 'Pays d’origine d’un article commercial',
    '8001' => 'Produits en rouleau - largeur/longueur/diamètre du mandrin', 
    '8002' => 'Numéro de série électronique (NSE) pour le téléphone cellulaire', 
    '8003' => 'numéro UPC/EAN et numéro de série de l’actif consigné', 
    '8004' => 'identification de série UPC/EAN', '8005' => 'prix par unité de mesure', 
    '8006' => 'Identification du composant d’un article commercial', 
    '8007' => 'numéro de compte bancaire international', 
    '8018' => 'Numéro de relation de service global EAN.UCC', 
    '8020' => 'Numéro de référence du bordereau de paiement', 
    '8100' => 'Code d’extension de coupon : Système de numéros et offre', 
    '8101' => 'Code d’extension de coupon : Système de numéros, offre, fin de l’offre', 
    '8102' => 'Code d’extension de coupon : Système de numéros précédé de 0', 
    '90' => 'Codes mutuellement convenus entre partenaires commerciaux', 
    '91' => 'Codes internes d’entreprise', 
    '92' => 'Codes internes d’entreprise', 
    '93' => 'Codes internes d’entreprise', 
    '94' => 'Codes internes d’entreprise', 
    '95' => 'Codes internes d’entreprise', 
    '96' => 'Codes internes d’entreprise', 
    '97' => 'Codes internes d’entreprise', 
    '98' => 'Codes d’entreprise internes', 
    '99' => 'Codes d’entreprise internes'
    );
   

/* Ajoute le code devant chaque texte pour plus de clarté */
foreach ($identifiers as $key => $value) {
    if ($key) {
        $identifiers[$key] = $key . ' - ' . $value;
    }
}

registerImageKey('code', 'BCGgs1128');

/* Valeurs et caractères valides pour Code 128 */
$vals = array();
for($i = 0; $i <= 127; $i++) {
    $vals[] = '%' . sprintf('%02X', $i);
}
$characters = array(
    'NUL','SOH','STX','ETX','EOT','ENQ','ACK','BEL','BS','TAB','LF','VT','FF','CR','SO','SI','DLE','DC1','DC2','DC3','DC4','NAK','SYN','ETB','CAN','EM','SUB','ESC','FS','GS','RS','US',
    '&nbsp;', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '*', '+', ',', '-', '.', '/', 
    '0','1','2','3','4','5','6','7','8','9', ':',';','<','=','>','?', '@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_',
    '`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~','DEL'
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
    <li class="option">
        <div class="title">
            <label for="identifier">Identifiants</label>
        </div>
        <div class="value">
            <?php echo getSelectHtml('identifier', null, $identifiers); ?>
            <div id="identifierContainer"></div>
        </div>
    </li>
</ul>

<div id="validCharacters">
    <h3>Caractères valides</h3>
    <?php $c = count($characters); for ($i = 0; $i < $c; $i++) { echo getButton($characters[$i], $vals[$i]); } ?>
</div>

<div id="explanation">
    <h3>Explication</h3>
    <ul>
        <li>Encodé en Code 128.</li>
        <li>Anciennement connu sous le nom UCC/EAN-128.</li>
        <li>Utilisé pour les conteneurs d’expédition.</li>
        <li>Basé sur la norme GS1.</li>
    </ul>
</div>

<script>
(function($) {
    "use strict";

    var identifierSelect = $("#identifier"),
        identifierContainer = $("#identifierContainer"),
        generateText = $("#text");

    var updateText = function() {
        var text = "";
        $(".gs1128_identifier").each(function() {
            var $this = $(this);
            text += "(" + $this.find(".gs1128_id").val() + ")" + $this.find(".gs1128_value").val() + "~F1";
        });
        text = text.substring(0, text.length - 3);
        generateText.val(text);
    };

    var addIdentifier = function(id) {
        var identifier = $("<div class='gs1128_identifier'><input type='text' value='" + id + "' class='gs1128_id' readonly='readonly' /> - <input type='text' class='gs1128_value' /><a href='#' class='gs1128_delete'><img src='delete.png' alt='Supprimer' /></a></div>")
            .appendTo(identifierContainer);

        identifier.find(".gs1128_delete").on("click", function() {
            $(this).closest(".gs1128_identifier").remove();
            updateText();
            return false;
        });
        identifier.find(".gs1128_value").on("keyup", function() {
            updateText();
        });

        identifierSelect.val();
        return;
    };

    identifierSelect.change(function() {
        addIdentifier($(this).find("option:selected").val());
        updateText();
    });

    generateText.on("keyup", function() {
        var val = $(this).val(),
            section = val.split("~F1"),
            i = 0, regex = /^\(([0-9]*y?)\)(.*)$/,
            result;

        $(".gs1128_identifier").remove();
        for (i = 0; i < section.length; i++) {
            result = regex.exec(section[i]);
            if (result.length === 3) {
                addIdentifier(result[1]);
                $(".gs1128_identifier").eq(i).find(".gs1128_value").val(result[2]);
            } else {
                $(".gs1128_identifier").remove();
                break;
            }
        }
    });

    $(function() {
        if (generateText.val() !== "") {
            generateText.keyup();
        }
    });
})(jQuery);
</script>

<?php
include('include/footer.php');
?>
