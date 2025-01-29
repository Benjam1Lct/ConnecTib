<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/global.css">
    <title>Sign In</title>
</head>
<body >
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
    
    <div class="mt-32 mb-20 mx-8 flex gap-4 h-[100vh]">

        <div class="uppercase text-[14px] w-80 h-fit font-extrabold border border-color-dark p-8 flex flex-col gap-6 ">
            <div class="itemsLeft flex flex-col gap-6">
                <p id="Dashboard" class="hover:text-gray-400 transition duration-300 cursor-pointer">Dashboard</p>
                <p id="Orders" class="hover:text-gray-400 transition duration-300 cursor-pointer">orders</p>
                <p id="Details" class="hover:text-gray-400 transition duration-300 cursor-pointer">account details</p>
                <?php 
                    if (session()->get('user')['type'] == 'admin') {
                ?>
                    <p id="Products" class="hover:text-gray-400 transition duration-300 cursor-pointer">Products</p>
                    <p id="Users" class="hover:text-gray-400 transition duration-300 cursor-pointer">Users</p>
                <?php
                    }
                ?>
            </div>
            <form action="/logout" method="post">
            <button type="submit" id="filters-toggle" class="uppercase border border-color-dark bg-color-bright group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                <span class="font-extrabold relative z-10 text-[#403A34] group-hover:text-[#F6F1EB] transition duration-300">
                    Log out
                </span>
                <div class="absolute inset-0 bg-[#403A34] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
            </button>
            </form>
        </div>

        <div class=" w-full h-fit min-h-fit">
            <div class="rightbox border border-color-dark w-full h-[100%]">
                <!--Dashboard -->
                <div id="DashboardBox" class="p-8 uppercase flex flex-col gap-8">
                    <div class="flex flex-col">
                        <p class="text-3xl ">welcome</p>
                        <?php $username = session()->get('user')['nom'] ?? 'Guest'; ?>
                        <p class="text-4xl special-font"> <?= esc($username) ?> </p>
                    </div>
                    <p class="w-full max-w-md text-[14px]">
                    From your account dashboard, you can view your recent orders, manage your shipping and billing addresses, and change your password and account details.
                    </p>
                    <a href="/products" id="filters-toggle" class="w-full border border-color-dark max-w-md bg-color-dark group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                        <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                            all products
                        </span>
                        <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                    </a>
                </div>
                <!--Orders -->
                <div id="OrdersBox" class="hidden p-8 uppercase flex flex-col gap-8">
                    <div class="flex flex-col gap-8 max-w-lg">
                        <p class="text-3xl ">Orders</p>
                        <a href="/allOrders" type="submit" id="filters-toggle" class="w-full border border-color-dark bg-color-dark group relative inline-block overflow-hidden py-6 px-12 w-full text-center cursor-pointer">
                            <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                manage orders
                            </span>
                            <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </a>
                    </div>
                </div>
                <!--Details -->
                <div id="DetailsBox" class="hidden  p-8 uppercase flex flex-col gap-8">
                    <div class="flex flex-col gap-8 w-full max-w-lg">
                        <p class="text-3xl ">Account Details</p>

                        <form action="/updateDetails" method="post">
                            <div class=" flex flex-col  border-x border-t border-color-dark text-[14px]">
                                <div class="flex w-full border-b border-color-dark">
                                    <input type="text" name="name" placeholder="NAME" class="uppercase p-4 w-full bg-color-bright border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark" value="<?php echo($userInfos->nom)?>">
                                    <input type="text" name="phone" placeholder="PHONE" class="uppercase p-4 w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark" value="<?php echo($userInfos->telephone) ?>">
                                </div>
                                <div class="flex w-full border-b border-color-dark">
                                    <input type="password" name="password" placeholder="new password" class="uppercase p-4 w-full bg-color-bright border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                                    <input type="password" name="confirm-password" placeholder="confirm new password" class="uppercase p-4 w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark">
                                </div>
                                <input type="text" name="adresse" placeholder="addresse" class="uppercase p-4 w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark" value="<?php echo($userInfos->adresse) ?>">
                                <input disabled type="text" class="border-t border-color-dark uppercase p-4 w-full bg-color-bright focus:outline-none focus:ring-0 focus:border-color-dark" value="<?php echo($userInfos->type_utilisateur) ?>">
                            </div>

                            <button type="submit" id="filters-toggle" class="w-full border border-color-dark bg-color-dark group relative inline-block overflow-hidden py-4 px-12 w-full text-center cursor-pointer">
                                <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                    UPDATE
                                </span>
                                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                            </button>
                        </form>
                    </div>
                </div>
                <?php 
                    if (session()->get('user')['type'] == 'admin') {
                ?>
                    <!--Products -->
                    <div id="ProductsBox" class="hidden  p-8 uppercase flex flex-col gap-8">
                        <div class="flex flex-col gap-8 w-full max-w-lg">
                            <p class="text-3xl ">Products</p>

                            <a href="/products/add" type="submit" id="filters-toggle" class="w-full border border-color-dark bg-color-dark group relative inline-block overflow-hidden py-4 px-8 w-full text-center cursor-pointer">
                                <span class="flex justify-between items-center font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                    <p>add products</p>
                                    <p class="text-5xl">+</p>
                                </span>
                                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                            </a>

                            <a href="/allProducts" type="submit" id="filters-toggle" class="w-full border border-color-dark bg-color-dark group relative inline-block overflow-hidden py-6 px-12 w-full text-center cursor-pointer">
                                <span class="font-extrabold relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                    manage products
                                </span>
                                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                            </a>

                        </div>
                    </div>
                    <!--Users -->
                    <div id="UsersBox" class="hidden  p-8 uppercase flex flex-col gap-8">
                        <div class="flex flex-col gap-8 w-full">
                            <p class="text-3xl ">Users</p>

                            <?php
                            foreach ($allUsers as $user):
                            ?>
                                <div class="flex w-full justify-between border border-color-dark">
                                    <div class="flex flex-col  p-8 uppercase">
                                        <p class="text-md"><?= $user->nom?></p>
                                        <p class="font-extrabold text-sm"><?= $user->type_utilisateur?></p>
                                    </div>
                                        <?php 
                                            if ($user->type_utilisateur == 'admin') {
                                        ?>
                                            <a href="/updateRole/<?= $user->id_utilisateur?>" type="submit" id="filters-toggle" class="w-full max-w-sm flex items-center justify-center border-l border-color-dark bg-red-600 group relative inline-block overflow-hidden py-6 px-12 w-full text-center cursor-pointer">

                                                <span class="font-extrabold special-font text-lg relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                                 downgrade role
                                                </span>
                                                <div class="absolute inset-0 bg-[#fecaca] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                                            </a>

                                        <?php
                                            } else {
                                        ?>
                                            <a href="/updateRole/<?= $user->id_utilisateur?>" type="submit" id="filters-toggle" class="w-full max-w-sm flex items-center justify-center border-l border-color-dark bg-green-600 group relative inline-block overflow-hidden py-6 px-12 w-full text-center cursor-pointer">

                                                <span class="font-extrabold special-font text-lg relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                                                    upgrade role
                                                </span>
                                                <div class="absolute inset-0 bg-[#bbf7d0] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                                            </a>

                                        <?php
                                            }
                                        ?>
                                    
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
        

        
    </div>
    

    <?php
    include 'sections/footer.php';
    ?>

    <script src="/js/profil.js"></script>

</body>
</html>
