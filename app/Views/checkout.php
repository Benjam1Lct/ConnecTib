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


    <form action="/checkout" method="POST">
    <?= csrf_field() ?>
    <div class="flex flex-col xl:flex-row justify-between items-center xl:items-start gap-16 my-40 mx-8">
        <div class="flex flex-col gap-8 w-full max-w-xl">
            <div class="w-full flex flex-col gap-4 justify-start items-start">
                <p class='special-font text-5xl'>BILLING METHOD</p>
                <div>
                    <select id="type_livraison" class="focus:outline-none focus:ring-0 focus:border-color-dark bg-color-bright p-4 border border-color-dark" name="type_livraison" onchange="this.form.submit()">
                    <option value="standard" <?= $selectedType == 'standard' ? 'selected' : '' ?>>Livraison Standard</option>
                    <option value="express" <?= $selectedType == 'express' ? 'selected' : '' ?>>Livraison Express</option>
                    <option value="gratuite" <?= $selectedType == 'gratuite' ? 'selected' : '' ?>>Livraison Gratuite</option>
                    </select>
                </div>
            </div>
    </form>

    <form action="/createCommande" method="POST" class="flex flex-col gap-8">
            <?= csrf_field() ?>
            <div class="flex flex-col gap-4">
                <!-- Cart -->
                <div class="w-full flex justify-between items-end">
                    <p class='special-font text-5xl'>BILLING INFORMATION</p>
                </div>

                <div class="flex flex-col text-[12px] w-full  border border-color-dark placeholder-yellow-950">
                    <div class="flex border-b border-color-dark">
                        <input type="text" name="lastname" id="" placeholder="LAST NAME *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                        <input type="text" name="firstname" id="" placeholder="FIRST NAME *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                    </div>

                    <input type="text" name="company" id="" placeholder="COMPANY" class="placeholder-yellow-950 w-full bg-color-bright p-4 border-b border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">

                    <div class="flex border-b border-color-dark">
                        <input type="text" name="city" id="" placeholder="CITY *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                        <input type="text" name="zipcode" id="" placeholder="ZIPCODE *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                    </div>

                    <div class="flex border-color-dark">
                        <select
                            class="uppercase w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark"
                            name="country" 
                            id="country" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none cursor-pointer">
                            <option value="us" selected>United States</option>
                            <option value="ca">Canada</option>
                            <option value="fr">France</option>
                            <option value="de">Germany</option>
                            <option value="jp">Japan</option>
                            <!-- Ajoutez d'autres pays si nécessaire -->
                        </select>                    
                        <input type="text" name="phone" id="" placeholder="PHONE *" required class="placeholder-yellow-950  w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                    </div>
                </div>
            </div>
            

            <div class="w-full flex flex-col justify-between gap-6 items-start">
                <p class='special-font text-5xl uppercase'>Delivery address</p>
                <div class="flex justify-center gap-4 text-[14px]">
                    <input id="checkboxDifferentAddress" type="checkbox" class="appearance-none h-4 w-4 border border-color-dark bg-color-bright  focus:ring-0 checked:bg-amber-950 cursor-pointer"                            />
                    <p class="uppercase">
                    Send to a different address
                    </p>
                </div>
                
                <div disabled id="formDifferentAddress" class="hidden flex flex-col text-[12px] w-full border border-color-dark placeholder-yellow-950">
                <div class="flex border-b border-color-dark">
                    <input disabled type="text" name="lastname" id="otherFormDelivery" placeholder="LAST NAME *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                    <input disabled type="text" name="firstname" id="otherFormDelivery" placeholder="FIRST NAME *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <input disabled type="text" name="company" id="otherFormDelivery" placeholder="COMPANY" class="placeholder-yellow-950 w-full bg-color-bright p-4 border-b border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">

                <div class="flex border-b border-color-dark">
                    <input disabled type="text" name="city" id="otherFormDelivery" placeholder="CITY *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                    <input disabled type="text" name="zipcode" id="otherFormDelivery" placeholder="ZIPCODE *" required class="placeholder-yellow-950 w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <div class="flex border-color-dark">
                    <select
                        class="uppercase w-full bg-color-bright p-4 border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark"
                        name="country" 
                        id="otherFormDelivery" 
                        disabled 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none cursor-pointer">
                        <option value="us" selected>United States</option>
                        <option value="ca">Canada</option>
                        <option value="fr">France</option>
                        <option value="de">Germany</option>
                        <option value="jp">Japan</option>
                        <!-- Ajoutez d'autres pays si nécessaire -->
                    </select>                    
                    <input disabled type="text" name="phone" id="otherFormDelivery" placeholder="PHONE *" required class="placeholder-yellow-950  w-full bg-color-bright p-4 focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>
            </div>
                
            </div>

            <div class="w-full flex flex-col items-start gap-6">
                <p class='special-font text-5xl uppercase'>Commentaires</p>
                <textarea id="story" name="story" class="resize-none w-full bg-color-bright border border-color-dark p-2 focus:outline-none focus:ring-0 focus:border-color-dark" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>

        </div>
        
        
        <div class="flex flex-col border border-color-dark w-full max-w-xl">
            <div class="flex flex-col w-full text-[14px] gap-2 p-4 border-b border-color-dark">
                <div class="flex justify-between w-full uppercase">
                    <p>DELAY</p>
                    <p class="font-extrabold"><?php echo number_format($livraisonCout, 2) ?>€</p>
                </div>
                <div class="flex justify-between w-full">
                    <p class="uppercase">Estimated delivery date</p>
                    <p class="font-extrabold"><?php echo ($deliveryDelai) ?> Day</p>
                </div>
                <div class="flex justify-between w-full uppercase">
                    <p>SUBTOTAL (HT)</p>
                    <p class="font-extrabold"><?php echo number_format($totalPrixHT, 2); ?> €</p>
                </div>
                <div class="flex justify-between w-full">
                    <p>TVA</p>
                    <p class="font-extrabold"><?php echo number_format($TVA, 2); ?> €</p>
                </div>
                
            </div>

            <div class="flex justify-between p-4 text-2xl special-font border-b border-color-dark">
                <p>TOTAL</p>
                <p><?php echo number_format($totalPrice, 2); ?> €</p>
                <input hidden type="number" name="totalPrice" value="<?php echo number_format($totalPrice, 2); ?>">
            </div>

            <div class="px-4 py-8 w-full border-b border-color-dark">
                <div class="space-y-2">
                    <!-- Option CB -->
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="payment-method" 
                            value="cb" 
                            class="form-radio h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500"
                            checked>
                        <span class="ml-3 text-gray-700 font-medium">Carte Bancaire</span>
                    </label>

                    <!-- Option PayPal -->
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="payment-method" 
                            value="paypal" 
                            class="form-radio h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-3 text-gray-700 font-medium">PayPal</span>
                    </label>

                    <!-- Option Virement -->
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="payment-method" 
                            value="virement" 
                            class="form-radio h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-3 text-gray-700 font-medium">Virement Bancaire</span>
                    </label>
                </div>
            </div>


            <div class="text-[14px] p-8 border-b border-color-dark">
                <p>
                It is important to check that the furniture ordered can be delivered to your home. If the customer lives in a specific area or one that is difficult to access (impassable stairwell and/or too narrow a lift, etc.) without it having been specified in advance, the delivery may be overcharged or cancelled. If you have any doubts, please contact our teams to find a suitable delivery solution.
                </p>
            </div>

            <div class="flex justify-center gap-4 text-[14px] p-8 border-b border-color-dark">
                <input type="checkbox" required class="appearance-none h-4 w-4 border border-color-dark bg-color-bright  focus:ring-0 checked:bg-amber-950 cursor-pointer"                            />
                <p>
                I have read and agree to the website <a href="#" class="underline">terms and conditions</a>
                </p>
            </div>

            <button type="submit" id="orderButtonOrder" id="filters-toggle" class="bg-color-dark group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                    ORDER
                </span>
                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
            </button>

            <button type="submit" id="paypalButtonOrder" class="p-4 hidden">
                <div id="filters-toggle" class=" bg-blue-700 hover:bg-blue-800 rounded-full group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer transition duration-300">
                    <span class="special-font font-extrabold relative z-10 text-[#F6F1EB] transition duration-300">
                        PAYPAL
                    </span>
                </div>
                </button>
            </div>
        </div>

    </form>

    
    

    <?php
    include 'sections/footer.php';
    ?>

    <script src="/js/checkout.js"></script>

    
</body>
</html>
