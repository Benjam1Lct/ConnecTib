<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connec'Tib - <?= $product->nom ?></title>
<link rel="stylesheet" href="/styles/global.css">
</head>
<body>
    <?php if (session()->get('error') || session()->get('success')): ?>
        <div class="fixed bottom-0 left-0 m-8 <?= session()->get('error') ? 'bg-red-400' : 'bg-green-400' ?>">
            <p class="py-4 px-8 text-white">
                <?= session()->get('error') ?? session()->get('success') ?>
            </p>
        </div>
    <?php endif; ?>


<div class="relative">
<div  class="absolute top-0 left-0 w-full h-full object-cover z-[-100]"> </div> <!-- Remplace par le chemin vers ton logo -->
<?php
include 'sections/header.php';
?>  

<form action="/cart/add" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="id_produit" value="<?= $product->id_produit ?>">
    <input type="hidden" name="prix" value="<?= $product->prix ?>">

    <div class="flex items-center justify-center h-screen mb-[18vh] mt-48 lg:mt-8">
        <div class="w-full max-w-4xl bg-color-bright gap-16 justify-between flex lg:flex-row flex-col items-center m-8">
            <img src="<?= $product->img_path ?>" class="w-1/2 border border-color-dark h-auto aspect-square object-cover" alt="Image du produit">
            <div class="grid grid-cols-2 grid-rows-4 text-[14px] w-96 uppercase">
                <div class=" p-4 gap-2 text-center col-span-2 border border-color-dark flex flex-col justify-center items-center">
                    <p>Quantity</p>
                    <input id="quantity" type="number" value="1" min="1" max="100" name="quantity" class="w-20 h-10 border-color-dark bg-color-bright rounded-none focus:outline-none focus:ring-0 focus:border-color-dark text-center border border-gray-400 rounded" />
                </div>
                <button type="submit" class="text-[18px] p-4 text-center flex justify-center items-center border-x border-b border-color-dark col-span-2 bg-color-dark text-color-bright uppercase font-extrabold cursor-pointer hover:bg-[#F6F1EB] hover:text-[#403A34] transition duration-300">ADD TO CART</button>
                <div class=" p-4 text-center flex justify-center items-center border-x border-b border-color-dark w-full font-extrabold"><?= $product->nom ?></div>
                <div class=" p-4 text-center flex justify-around items-center border-r border-b border-color-dark "><?= $product->categorie ?></div>   
                <div class=" p-4 text-center flex justify-center items-center border-x border-b border-color-dark w-full col-span-2 font-extrabold text-4xl special-font"><?= $product->prix ?>€</div>
            </div>  
        </div>
    </div>
</form>

    </div>

    <?php
    include 'sections/footer.php';
    ?>
        
    </body>
    </html>
