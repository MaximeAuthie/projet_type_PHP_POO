        <div class="card w-50 mx-auto mt-5 mb-5">
            <div class="card-header text-center">
                <h1>Vos informations</h1>
            </div>
            <div class="card-body">
                <br>
                <h4>Informations personnelles : </h4>
                <form action="#" method="post" class="ms-3 me-3">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control text-center" id="pseudo" value="<?php echo $pseudo ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse mail</label>
                        <input type="email" class="form-control text-center" id="mail" value="<?php echo $mail ?>" disabled>
                    </div>
                </form>
                <br>
                <h4>Personnages : </h4>
                <?php
                    $arrayCharacters = $this->getListPerso();
                    foreach ($arrayCharacters as $item) {
                        $characterClass = $item->getClasse();
                        echo    '<div class="card w-50 mx-auto mt-5">
                                    <div class="card-header text-center">
                                        <h4>'.$item->getNom().'</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="pseudo" class="form-label">Classe</label>
                                            <input type="text" class="form-control text-center" id="pseudo" value="'.$characterClass->getNom().'" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pseudo" class="form-label">Points de vie</label>
                                            <input type="text" class="form-control text-center" id="pseudo" value="'.$characterClass->getPointsDeVie().'" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pseudo" class="form-label">Attaque</label>
                                            <input type="text" class="form-control text-center" id="pseudo" value="'.$characterClass->getAttaque().'" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pseudo" class="form-label">Attaque</label>
                                            <input type="text" class="form-control text-center" id="pseudo" value="'.$characterClass->getDefense().'" disabled>
                                        </div>
                                    </div>
                                </div>';
                    }
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </body>
</html>