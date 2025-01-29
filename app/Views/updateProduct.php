<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/global.css">
    <title>Modifier un produit</title>
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

    <div class="flex flex-col gap-8 mt-36 mb-16 mx-8 w-full h-[100vh] max-w-xl">
        <p class="special-font text-5xl uppercase">Edit product</p>
        <form action="/products/updateProduct" method="post" class="flex flex-col w-full">
            <input type="hidden" name="id" value="<?= $products->id_produit ?>">

            <input type="text" name="nom" value="<?= $products->nom ?>" placeholder="Name" required class="uppercase p-4 border border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
            
            <input type="text" name="categorie" value="<?= $products->categorie ?>" placeholder="Categorie" required class="uppercase p-4 border-x border-b border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
            
            <textarea name="description" placeholder="Description" required class="uppercase resize-none p-4 border-x border-b border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark"><?= $products->description ?></textarea>
            
            <input type="number" name="prix" value="<?= $products->prix ?>" placeholder="Price" step="0.01" required class="uppercase p-4 border-x border-b border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
            
            <input type="number" name="stock" value="<?= $products->stock ?>" placeholder="Quantity" required class="uppercase p-4 border-x border-b border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
            
            <input type="text" name="img_path" value="<?= $products->img_path ?>" placeholder="image path (/images/*)" required class="uppercase p-4 border-x border-b border-color-dark w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
            
            <button type="submit" id="filters-toggle" class="w-full border-x border-b border-color-dark bg-color-dark group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                <span class="uppercase font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                    Save changes
                </span>
                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
            </button>
        </form>
    </div>    

    <?php
    include 'sections/footer.php';
    ?>
</body>
</html>
