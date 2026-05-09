<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4 col-md-6 mx-auto">
            <h3>Créer un compte</h3>
            <form id="identityForm">
                <input type="text" name="nom" class="form-control mb-2" placeholder="Nom complet" required>
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="mot_de_passe" class="form-control mb-2" placeholder="Mot de passe" required>
                <select name="genre" class="form-control mb-3">
                    <option value="M">Homme</option>
                    <option value="F">Femme</option>
                </select>
                <button type="submit" class="btn btn-primary w-100">Suivant</button>
            </form>
            <div id="msg" class="mt-2"></div>
        </div>
    </div>

<script>
document.getElementById('identityForm').onsubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const response = await fetch('<?= site_url('register-identity') ?>', {
        method: 'POST',
        body: formData
    });
    // On suppose que le contrôleur redirige ou renvoie un succès
    if(response.ok) window.location.href = '<?= site_url('inscription-sante') ?>';
};
</script>

</body>
</html>