
                <h1 class="text-center mt-5 mb-5">Vos personnages</h1>
                <div class="w-25 mx-auto d-grid text-center mb-5">
                <a class="nav-link" href="addCharacter"><button class="btn btn-primary" type="button">Ajouter un personnage</button></a>
                </div>
                <?php
                    $arrayCharacters = $this->getListPerso();
                    foreach ($arrayCharacters as $item) {
                        $characterClass = $item->getClasse();
                        echo    '<div class="card w-50 mx-auto mb-5">
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