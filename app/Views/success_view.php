<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success_view</title>
</head>
<body>
    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="display-3"> Bravo !</h1>
        <p class="lead">Votre profil est prêt. Nous avons calculé votre IMC et vos besoins.</p>
        <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-primary btn-lg mt-3">Aller au Dashboard</a>
    </div>
</body>
</html>