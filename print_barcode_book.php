<?php 
// Démarrer la mise en mémoire tampon de sortie
ob_start();

include ('include/dbcon.php');

// Démarrer la session uniquement si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('session.php'); // Script de validation de session

// Vérifier si les variables de session sont définies avant de les utiliser
if (!isset($_SESSION['book_title']) || !isset($_SESSION['book_pub'])) {
    die("Erreur : Le titre du livre ou l’éditeur n’est pas défini dans la session. Veuillez effectuer une recherche d’abord.");
}
?>
<html>
<head>
    <title>Système de gestion de bibliothèque - Impression des Codes-barres des Livres</title>
    <style>
        .container {
            width: 100%;
            margin: auto;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse; /* Garantit des bordures propres */
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd; /* Bordure gris clair pour les cellules */
        }
        .table th {
            background-color: #f2f2f2; /* En-tête gris clair */
            text-align: left;
        }
        .table-striped tbody > tr:nth-child(odd) > td,
        .table-striped tbody > tr:nth-child(odd) > th {
            background-color: #f9f9f9;
        }
        @media print {
            #print {
                display: none;
            }
        }
        #print {
            width: 90px;
            height: 30px;
            font-size: 18px;
            background: white;
            border-radius: 4px;
            margin-left: 28px;
            cursor: pointer;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <div id="header">
           <center><h5 style="font-style:Calibri; margin-top:-14px;">Système de Gestion de Bibliothèque</h5></center>
        </div>
        <hr style="border: solid black 1px">
        <button type="submit" id="print" onclick="printPage()">Imprimer</button>
        <p style="margin-left:30px; margin-top:5px; margin-bottom: 0px;font-size:14pt; font-style: italic;">Liste des Codes-barres des Livres</p>
        <div align="right">
            <b style="color:blue;">Date de Préparation :</b>
            <?php echo date("l, d-m-Y"); ?>
        </div>
        <br/>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align:center; width: 40%;">Image du Code-barres</th>
                    <th style="text-align:center;">Code-barres</th>
                    <th style="text-align:center;">Titre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Utiliser des requêtes préparées pour la sécurité
                    $book_title_param = $_SESSION['book_title'];
                    $book_pub_param = $_SESSION['book_pub'];
                    
                    $stmt = mysqli_prepare($con, "SELECT book_barcode, book_title FROM book WHERE book_title = ? AND book_pub = ? ORDER BY book_id DESC");
                    mysqli_stmt_bind_param($stmt, "ss", $book_title_param, $book_pub_param);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td style="text-align:center;">
                        <?php
                            // Encoder le code-barres de manière sécurisée pour l’URL
                            $barcode_safe_for_url = urlencode($row['book_barcode']);
                            // Pointer la source de l’image vers le nouveau script moderne de génération
                            echo '<img src="generate_barcode.php?code=' . $barcode_safe_for_url . '" alt="Code-barres pour ' . htmlspecialchars($row['book_barcode']) . '">';
                        ?>
                    </td>
                    <td style="text-align:center; vertical-align: middle;"><?php echo htmlspecialchars($row['book_barcode']); ?></td>
                    <td style="text-align:center; vertical-align: middle;"><?php echo htmlspecialchars($row['book_title']); ?></td>
                </tr>
                <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" style="text-align:center;">Aucun livre trouvé correspondant aux critères.</td></tr>';
                    }
                    mysqli_stmt_close($stmt);
                ?>
            </tbody>
        </table>
        <br />
        <br />
        <?php
            $user_query = mysqli_query($con, "SELECT firstname, lastname FROM admin WHERE admin_id='$id_session'") or die(mysqli_error($con));
            if ($row = mysqli_fetch_array($user_query)) {
        ?>
        <div style="margin-left: 28px;">
            <p><strong>Préparé par :</strong><br><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></p>
        </div>
        <?php } ?>
    </div>
</body>
</html>
<?php
// Vider la mémoire tampon de sortie
ob_end_flush();
?>
