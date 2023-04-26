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
                <ul class="list-group">
                    <?php echo $listCharacters; ?>
                </ul>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </body>
</html>