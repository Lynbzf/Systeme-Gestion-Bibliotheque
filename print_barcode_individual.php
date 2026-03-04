<?php
include ('include/dbcon.php');

// Démarrer la session pour accéder aux variables de session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$code = isset($_GET['code']) ? $_GET['code'] : '';

// Récupérer le titre du livre associé au code-barres
$book_title = '';
if (!empty($code)) {
    // Utiliser des requêtes préparées pour une meilleure sécurité
    $stmt = mysqli_prepare($con, "SELECT book_title FROM book WHERE book_barcode = ?");
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
    
    if ($row1 = mysqli_fetch_array($result1)) {
        $book_title = $row1['book_title'];
    }
    mysqli_stmt_close($stmt);
}
?>
<html>
<head>
    <title>Système de gestion de bibliothèque - Impression du Code-barres</title>
    <style>
        .container { width: 100%; margin: auto; }
        hr { border: solid black 1px; }
        @media print {
            #print { display: none; }
        }
        #print {
            width: 90px;
            height: 30px;
            font-size: 18px;
            background: white;
            border-radius: 4px;
            margin-left: 28px;
            cursor: pointer;
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
        <hr>
        <button type="submit" id="print" onclick="printPage()">Imprimer</button>
        <div align="right">
            <b style="color:blue;">Date de Préparation :</b> <?php echo date("l, d-m-Y"); ?>
        </div>
        <br/>
        
        <!-- === SECTION DU CODE-BARRES MISE À JOUR === -->
        <div style="text-align: left; margin-left: 28px;">
            <?php
            if (!empty($code)) {
                // Encoder le code-barres de manière sécurisée pour l’URL
                $barcode_safe_for_url = urlencode($code);

                // Pointer la source de l’image vers le nouveau script moderne de génération
                echo '<img src="generate_barcode.php?code=' . $barcode_safe_for_url . '" alt="Code-barres pour ' . htmlspecialchars($code) . '">';
                
                // Afficher le titre du livre sous le code-barres
                echo "<h4>" . htmlspecialchars($book_title) . "</h4>";

            } else {
                echo "<p>Aucun code-barres spécifié.</p>";
            }
            ?>
        </div>
        <br />
        <br />
        
        <!-- Section Préparé par -->
        <?php
            if (isset($_SESSION['id'])) {
                $id_session = $_SESSION['id'];
                // Utiliser ici aussi une requête préparée pour la sécurité
                $stmt_user = mysqli_prepare($con, "SELECT firstname, lastname FROM admin WHERE admin_id = ?");
                mysqli_stmt_bind_param($stmt_user, "i", $id_session);
                mysqli_stmt_execute($stmt_user);
                $user_result = mysqli_stmt_get_result($stmt_user);

                if ($row_user = mysqli_fetch_array($user_result)) {
            ?>
                    <div style="margin-left: 28px;">
                        <span style="font-weight: bold;">Préparé par :</span><br>
                        <span><?php echo htmlspecialchars($row_user['firstname'] . " " . $row_user['lastname']); ?></span>
                    </div>
            <?php
                }
                mysqli_stmt_close($stmt_user);
            }
            ?>
    </div>
</body>
</html>
