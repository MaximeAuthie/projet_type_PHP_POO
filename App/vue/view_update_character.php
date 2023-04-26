        <div class="card w-50 mx-auto mt-5">
            <div class="card-header text-center">
                <h1>Modifier un personnage</h1>
            </div>
            <div class="card-body p-5">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $nom; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Choisir une classe</label>
                        <select class="form-select" aria-label="Default select example" name="class">
                            <?php echo $options ?>
                        </select>
                    </div>
                    <div class="d-grid w-25 mx-auto mt-3">
                        <button type="submit" class="btn btn-primary" name="submit_update_character">Mettre à jour</button>
                    </div>   
                </form>
            </div>
        </div>
        <?php echo $message ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>   
    </body>
</html>