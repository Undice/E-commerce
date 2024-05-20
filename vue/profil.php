<?php
$idUser = $_SESSION['idUser'];
$userInfo = recupUserInfo($pdo, $idUser);
?>

<main class="profil">
  <section class="col-8 mx-auto">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4 w-25" src="../public/assets/images/profil.png">
      <h2>Mes informations personnelles</h2>
    </div>
    <form class="text-center" method="get" action="">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="prenom" class="form-label">Prenom</label>
          <input type="text" class="form-control form-control-lg" id="prenom" value="<?php echo htmlspecialchars($userInfo['prenom'], ENT_QUOTES, 'UTF-8'); ?>" />
        </div>

        <div class="col-md-6">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" class="form-control form-control-lg" id="nom" value="<?php echo htmlspecialchars($userInfo['nom_user'], ENT_QUOTES, 'UTF-8'); ?>" />
        </div>

        <div class="col-md-6">
          <label for="tel" class="form-label">Numéro de téléphone</label>
          <input type="tel" id="tel" name="tel" class="form-control form-control-lg" value="<?php echo htmlspecialchars($userInfo['telephone'], ENT_QUOTES, 'UTF-8'); ?>" />
        </div>

        <div class="col-md-6">
          <label for="anniversaire" class="form-label">Date de naissance</label>
          <input type="date" id="anniversaire" name="anniversaire" class="form-control form-control-lg" value="<?php echo htmlspecialchars($userInfo['anniversaire'], ENT_QUOTES, 'UTF-8'); ?>" max="<?php echo htmlspecialchars(date('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>" />
        </div>

        <div class="col-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control form-control-lg" id="email" value="<?php echo htmlspecialchars($userInfo['email'], ENT_QUOTES, 'UTF-8'); ?>" readonly />
        </div>

        <div class="col-12">
          <label for="address" class="form-label">Adresse</label>
          <input type="text" class="form-control form-control-lg" id="address" value="<?php echo htmlspecialchars($userInfo['adresse'], ENT_QUOTES, 'UTF-8'); ?>" />
        </div>

        <div class="col-md-6">
          <label for="departement" class="form-label">Département</label>
          <select class="form-select form-select-lg" id="departement">
            <option value="<?php echo htmlspecialchars($userInfo['id_departement'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($userInfo['numero'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($userInfo['nom_departement'], ENT_QUOTES, 'UTF-8'); ?></option>
            <option></option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="ville" class="form-label">Ville</label>
          <select class="form-select form-select-lg" id="ville">
            <option value="<?php echo htmlspecialchars($userInfo['id_ville'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($userInfo['nom_ville'], ENT_QUOTES, 'UTF-8'); ?> (<?php echo htmlspecialchars($userInfo['code_postal'], ENT_QUOTES, 'UTF-8'); ?>)</option>
            <option></option>
          </select>
        </div>
      </div>
      <a href="../public/index.php?page=13">Mes factures</a><br>
      <a id="mdpChange">Changer mon mot de passe</a><br>
      <a href="../controler/traitement_deconnexion.php">Déconnexion</a>

    </form>
  </section>

  <section id="mdpHide" class="col-8 mx-auto d-none">
    <form class="text-center">
      <div class="row g-3">
        <div class="col-12">
          <label for="email" class="form-label">Ancien mot de passe</label>
          <input type="password" class="form-control form-control-lg" id="email" />
        </div>

        <div class="col-12">
          <label for="email" class="form-label">Nouveau mot de passe</label>
          <input type="password" class="form-control form-control-lg" id="email" />
        </div>

        <div class="col-12">
          <label for="email" class="form-label">Confirmer mot de passe</label>
          <input type="password" class="form-control form-control-lg" id="email" />
        </div>
      </div>

    </form>
  </section>
</main>