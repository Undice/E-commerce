<main class="contact">
    <section class="w-75 mx-auto">

        <h1 class="text-center">Formulaire de contact</h1>

        <form class="w-75 mx-auto" method="get" action="../controler/traitement_contact.php">

            <p class="text-success text-center">
                <?php
                if (isset($_GET['message'])) {
                    if ($_GET['message'] == 'valide') {
                        echo "Le message a bien été envoyé";
                    }
                }
                ?>
            </p>

            <div class="form-outline mb-4">
                <label class="form-label" for="nom">Nom & prénom</label>
                <input type="text" id="nom" name="nom" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="sujet">Sujet</label>
                <input type="text" id="sujet" name="sujet" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="message">Message</label>
                <textarea id="message" name="message" class="form-control form-control-lg" placeholder="Votre message"></textarea>
            </div>

            <input class="btn btn-lg bg-lb text-white m-2" type="submit" value="Envoyer" name="envoyer">

        </form>

    </section>
</main>