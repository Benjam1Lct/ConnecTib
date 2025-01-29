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
        <h1 class="special-font text-5xl">All Orders</h1>
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border border-gray-300 text-center px-4 py-2">ID</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Date</th>
                    <th class="border border-gray-300 text-center px-4 py-2">statut</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Total Price</th>
                    <th class="border border-gray-300 text-center px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userOrders as $order): ?>
                    <tr>
                        <form action="/detailsOrder" method="post">
                            <input hidden type="number" name="id_commande" value="<?= $order->id_commande ?>">
                            <input hidden type="text" name="date" value="<?= $order->date ?>">
                            <input hidden type="text" name="statut" value="<?= $order->statut ?>">
                            <input hidden type="number" name="prixtotal" value="<?= $order->prixtotal ?>">

                            <td class="border border-gray-300 text-center px-4 py-2"><?= $order->id_commande ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $order->date ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $order->statut ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2"><?= $order->prixtotal ?></td>
                            <td class="border border-gray-300 text-center px-4 py-2">
                                <button type="submit" class="text-blue-500 hover:underline">Details</button>
                            </td>
                        </form>
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
