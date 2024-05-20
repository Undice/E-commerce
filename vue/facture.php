<?php
session_start();
require "../modele/connexionbdd.php";
require "../modele/fonctions.php";

$idUser = $_SESSION['idUser'];
$factures = verifFacture($pdo, $idUser, $idFacture);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex ">
    <title>Facture</title>
    <style>
        body {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px 20px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .infos {
            width: 100%;
            margin-bottom: 20%;
        }

        .fright {
            float: right;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.8em;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="infos">
        <div>
            <strong>Émetteur:</strong><br>
            Kappy<br>
            87 rue Pierre De Coubertin<br>
            31090 Toulouse<br>
            +33 1 77 38 59 13<br>
            kappy@gmail.com<br>
        </div>
        <div class="fright">
            <strong>Facture n°:</strong> <?php echo htmlspecialchars($factures[0]['numero_facture'], ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Date:</strong> <?php echo htmlspecialchars($factures[0]['date_facturation'], ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Destinataire:</strong><br>
            <?php echo htmlspecialchars($factures[0]['nom_user'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($factures[0]['prenom'], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php echo htmlspecialchars($factures[0]['adresse'], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php echo htmlspecialchars($factures[0]['code_postal'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($factures[0]['nom_ville'], ENT_QUOTES, 'UTF-8'); ?><br>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($factures as $facture) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($facture['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($facture['qte_com'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($facture['prix_unit'], ENT_QUOTES, 'UTF-8'); ?>€</td>
                    <td><?php echo htmlspecialchars($facture['prix_unit'], ENT_QUOTES, 'UTF-8') * htmlspecialchars($facture['qte_com'], ENT_QUOTES, 'UTF-8'); ?>€</td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                <td><?php echo htmlspecialchars($factures[0]['montant'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Kappy - SIRET: 777 888 999 00022 - Autres informations
    </div>

</body>

</html>