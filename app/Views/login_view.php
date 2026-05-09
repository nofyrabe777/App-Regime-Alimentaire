<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_view</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 col-md-4 mx-auto">
            <h4 class="text-center">Connexion</h4>
            <form id="loginForm">
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="mot_de_passe" class="form-control mb-3" placeholder="Mot de passe" required>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
            <div id="errorMsg" class="text-danger mt-2"></div>
        </div>
    </div>

<script>
document.getElementById('loginForm').onsubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const response = await fetch('<?= site_url('authentification') ?>', {
        method: 'POST',
        body: formData
    });
    
    if (response.redirected) {
        window.location.href = response.url;
    } else {
        document.getElementById('errorMsg').innerText = "Identifiants invalides.";
    }
};
</script>

</body>
</html>