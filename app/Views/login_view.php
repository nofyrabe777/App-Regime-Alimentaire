<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_view</title>
</head>
<body>
    <form id="identityForm" action="<?= site_url('register-identity') ?>" method="POST">
    <?= csrf_field() ?> <input type="text" name="nom" class="form-control mb-2" placeholder="Nom complet" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="mot_de_passe" class="form-control mb-2" placeholder="Mot de passe" required>
    <select name="genre" class="form-control mb-3">
        <option value="M">Homme</option>
        <option value="F">Femme</option>
    </select>
    <button type="submit" class="btn btn-primary w-100">Suivant</button>
</form>

<script>
document.getElementById('identityForm').onsubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(e.target.action, {
            method: 'POST',
            body: formData,
            // On ajoute l'entête X-Requested-With pour que CI4 sache que c'est de l'AJAX
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if(response.ok) {
            window.location.href = '<?= site_url('inscription-sante') ?>';
        } else {
            document.getElementById('msg').innerHTML = "<span class='text-danger'>Erreur lors de l'envoi</span>";
        }
    } catch (error) {
        console.error("Erreur:", error);
    }
};
</script>

</body>
</html>