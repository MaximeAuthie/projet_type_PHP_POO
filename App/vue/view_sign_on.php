        <div class="card w-50 mx-auto mt-5">
            <div class="card-header text-center">
                <h1>Inscription</h1>
            </div>
            <div class="card-body p-5">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse mail</label>
                        <input type="email" class="form-control" name="mail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="d-grid w-25 mx-auto mt-3">
                        <button type="submit" class="btn btn-primary" name="submit_sign_on">S'inscrire</button>
                    </div>   
                </form>
            </div>
        </div>
        <?php echo $message ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>   
    </body>
</html>