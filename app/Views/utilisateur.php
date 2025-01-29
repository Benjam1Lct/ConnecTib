<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>

    <?php if (isset($utilisateur) && !empty($utilisateur)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateur as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_utilisateur'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['telephone'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['adresse'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['type_utilisateur'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>

</body>
</html>
