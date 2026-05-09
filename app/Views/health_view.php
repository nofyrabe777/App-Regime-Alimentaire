<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>health_view</title>
</head>
<body>
    <div class="container mt-5 text-center">
        <h3>Dites-nous en plus sur vous</h3>
        <form action="<?= site_url('register-healthy') ?>" method="POST" class="col-md-4 mx-auto">
            <div class="input-group mb-3">
                <input type="number" step="0.01" name="taille" class="form-control" placeholder="Taille (m)" required>
                <span class="input-group-text">m</span>
            </div>
            <div class="input-group mb-3">
                <input type="number" step="0.1" name="poids" class="form-control" placeholder="Poids (kg)" required>
                <span class="input-group-text">kg</span>
            </div>
            <input type="number" name="age" class="form-control mb-3" placeholder="Votre âge" required>
            <button type="submit" class="btn btn-success w-100">Calculer mon programme</button>
        </form>
    </div>
</body>
</html>