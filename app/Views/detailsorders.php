<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
</head>
<body>
    <?php if (session()->get('error') || session()->get('success')): ?>
        <div class="fixed bottom-0 left-0 m-8 <?= session()->get('error') ? 'bg-red-400' : 'bg-green-400' ?>">
            <p class="py-4 px-8 text-white">
                <?= session()->get('error') ?? session()->get('success') ?>
            </p>
        </div>
    <?php endif; ?>

    <?php
    include 'sections/header.php';
    ?>

    <div class="flex flex-col gap-8 mt-36 mb-16 mx-8 w-full h-[100vh] max-w-2xl">
        <h1 class="special-font text-5xl">Orders Details</h1>
        <div class="uppercase">
            <p>Commande #<?= $id_commande ?></p>
            <p><?= $date ?></p>
            <p><?= $statut ?></p>
            <p><?= $prixtotal ?>€</p>
        </div>
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border border-gray-300 text-center px-4 py-2">ID</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Nom</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Catégorie</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Description</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Prix Unitaire</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeProduits as $product): ?>

                        <tr>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $product->id_produit ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $product->nom ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $product->categorie ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $product->description ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $product->prix ?>€</td>
                            <td class="border border-gray-300 text-center px-4 py-2">
                                <img src="<?= $product->img_path ?>" alt="Produit" class="w-12 h-12 object-cover">
                            </td>
                            
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    

    <?php
    include 'sections/footer.php';
    ?>
</body>
</html>
