<?php
$factures = recupFacture($pdo, $_SESSION['idUser']);
?>

<main>
    <h2 class="text-center py-5">Mes factures</h2>
    <?php if ($factures) { ?>
        <div class="card col-10 col-xl-6 mx-auto p-3">
            <table>
                <thead>
                    <tr>
                        <th class="p-2 text-center">Numéro de commande</th>
                        <th class="p-2 text-center">Date de commande</th>
                        <th class="p-2 text-center">Montant de commande</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($factures as $facture) {
                    ?>
                        <tr>
                            <td class="text-center p-2"><?php echo htmlspecialchars($facture['numero_facture'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center p-2"><?php echo htmlspecialchars($facture['date_facturation'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center p-2"><?php echo htmlspecialchars($facture['montant'], ENT_QUOTES, 'UTF-8'); ?>€</td>
                            <td class="text-center p-2"><a href="../controler/genererpdf.php?idFacture=<?php echo htmlspecialchars($facture['id_facture'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p class="text-center">
            Vous n'avez pas encore de facture pour le moment
        </p>
    <?php } ?>
</main>