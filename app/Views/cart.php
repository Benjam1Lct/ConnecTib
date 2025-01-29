<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connec'Tib</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body>

    <?php
    include 'sections/header.php';
    ?>

    <div class="flex flex-col xl:flex-row justify-between items-center xl:items-start gap-16 my-40 mx-8">
        <div class="flex flex-col gap-8 w-full max-w-xl">
                <!-- Cart -->
            <div class="w-full flex justify-between items-end">
                <p class='special-font text-6xl'>YOUR CART</p>
                <p class='text-sm'>(<?php echo($cartSize) ?>)</p>
            </div>

            <form action="/cart" method="get">
            <div class="flex">
                <input type="text" class="w-full bg-color-bright border border-color-dark p-4 focus:outline-none focus:ring-0 focus:border-color-dark" placeholder="PROMO CODE">
                <button type="submit" class="bg-color-dark text-color-bright border-color-dark p-4">APPLY</button>
            </div>
            </form>

            <?php
                foreach ($panierProducts as $panierSingleProduct):
            ?>
                <?php
                    foreach ($allProductsDetails as $productDetail) {
                        if ($panierSingleProduct->id_produit == $productDetail->id_produit) {
                ?>
                    <div class="flex flex-col">
                        <div class="flex w-full border border-color-dark">
                            <a href="/productsItem/<?= $productDetail->id_produit ?>">
                                <img src="<?php echo($productDetail->img_path) ?>" alt="" class="w-80 h-44 object-cover border-r border-color-dark">
                            </a>
                            <div class="flex flex-col w-full">
                                <div class="flex items-end w-full h-fit justify-end items-end p-2 border-b border-color-dark">
                                    <a href="/cart/delete/<?php echo($panierSingleProduct->id_pan_prod) ?>" class="text-[12px]">DELETE</a>
                                </div>
                                <div class="flex flex-col  w-full h-full justify-between items-end p-2">
                                    <p class="text-[12px] font-extrabold">(x<?php echo($panierSingleProduct->quantite) ?>)</p>
                                    <p class="text-4xl special-font"><?php echo($panierSingleProduct->prix) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-full p-2 border-x border-b border-color-dark text-[12px]">
                            <div class="flex items-end justify-between uppercase"> 
                                <p>NAME</p>
                                <p class="font-extrabold"><?php echo($productDetail->nom) ?></p>
                            </div>
                            <div class="flex items-end justify-between uppercase"> 
                                <p>CATEGORY</p>
                                <p class="font-extrabold"><?php echo($productDetail->categorie) ?></p>
                            </div>
                            <div class="flex items-end justify-between">
                                <p>DESCRIPTION</p>
                                <p class="font-extrabold"><?php echo($productDetail->description) ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                        break;
                    }
                }
                ?>
            <?php endforeach; ?>

        </div>
        
        
        <div class="flex flex-col border border-color-dark w-full max-w-lg">
            <div class="flex flex-col w-full text-[14px] gap-2 p-4 border-b border-color-dark">
                <div class="flex justify-between w-full">
                    <p>SUBTOTAL</p>
                    <p class="font-extrabold"><?php echo($totalPrice) ?>€</p>
                </div>
                <div class="flex justify-between w-full">
                    <p>TVA</p>
                    <p class="font-extrabold">Calculated in the next step</p>
                </div>
                <div class="flex justify-between w-full">
                    <p>DELIVERY</p>
                    <p class="font-extrabold">Calculated in the next step</p>
                </div>
            </div>

            <div class="flex justify-between p-4 text-4xl special-font">
                <p>TOTAL</p>
                <p ><?php echo($totalPrice) ?>€</p>
            </div>

            <div class="text-[14px] p-8 border-b border-color-dark">
                <p>
                It is important to check that the furniture ordered can be delivered to your home. If the customer lives in a specific area or one that is difficult to access (impassable stairwell and/or too narrow a lift, etc.) without it having been specified in advance, the delivery may be overcharged or cancelled. If you have any doubts, please contact our teams to find a suitable delivery solution.
                </p>
            </div>

            <a href="/checkout" id="filters-toggle" class="bg-color-dark group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                    CHECKOUT
                </span>
                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
            </a>
        </div>
    </div>
    

    <?php
    include 'sections/footer.php';
    ?>

    
</body>
</html>
