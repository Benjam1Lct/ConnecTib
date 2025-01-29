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

    <div class="flex flex-col">
        <div class=" w-full h-[100vh] flex">
            <div class="relative w-full h-[calc(100% - 8rem)] flex m-8 border border-color-dark">
                <img src="/images/background.png" alt="" class="w-full h-full object-cover z-[-1]">
                <div class="absolute bottom-0 left-0 p-8 flex flex-col items-start z-1 special-font">
                    <p class="uppercase text-2xl text-color-bright">shin guard</p>
                    <p class="uppercase text-8xl text-color-bright font-extrabold">ProTib 3</p>
                </div>
            </div>
        </div>
        
        <div class="m-8 flex flex-col gap-12 mt-12">
        <p class="uppercase text-4xl special-font w-full max-w-[65%]">
            Connec'Tib, REVOLUTIONIZING SPORTS PROTECTION WITH INNOVATIVE AND CONNECTED SHIN GUARDS MADE IN FRANCE.
        </p>

        <div class="relative overflow-hidden inline-block">
                <a href="/about" class="group relative inline-block py-4 px-12 border border-color-dark">
                    <span class="text-[14px] font-extrabold relative z-10 text-[#403A34] group-hover:text-[#F6F1EB] transition duration-300">
                        OUR CONCEPT
                    </span>
                    <div class="absolute inset-0 bg-[#403A34] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                </a>
            </div>
        </div>


        <div class=" flex flex-col gap-48 m-8 mb-44">
            <!-- Products -->
            <div class=" flex ">
                <!-- Left -->
                <div class="w-full flex items-end gap-4">

                    
                        <a href="/products" class="group relative flew text-center overflow-hidden	w-[60vw] py-8 px-4 border border-color-dark">
                            <span class="font-extrabold text-[14px]  relative z-10 text-[#403A34] group-hover:text-[#F6F1EB] transition duration-300">
                                ALL PRODUCT
                            </span>
                            <div class="absolute inset-0 bg-[#403A34] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </a>

                        <?php if (!empty($produit1)): ?>

                            <a href="/productsItem/<?= $produit1->id_produit ?>" class="group relative block w-full scale-base md:scale-medium lg:scale-large">
                                <!-- Conteneur de l'image avec overflow-hidden -->
                                <div class="w-full h-full overflow-hidden transition-all duration-500 ease-in-out border border-color-dark">
                                <img src="<?= $produit1->img_path ?>"  alt="ProTib 3" 
                                        class="h-full w-full object-cover scale-110 transition-transform duration-500 group-hover:scale-100">
                                </div>

                                <!-- Rectangle apparaissant vers le haut (gauche) -->
                                <div class="border border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-8 md:h-10 bg-color-bright flex transition-all duration-500 ease-out opacity-0 opacity-100">
                                    <!-- Sous-rectangle gauche (blanc) -->
                                    <div class="flex-1 bg-color-bright flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold text-left"><?= $produit1->categorie ?></p>
                                    </div>
                                    <!-- Sous-rectangle droit (noir) -->
                                    <div class="flex-1 bg-color-dark flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-bright text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold">Discover</p>
                                    </div>
                                </div>

                                <!-- Rectangle apparaissant vers le bas (gauche) -->
                                <div class="border-x border-b border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-16 md:h-24 bg-color-bright flex items-center justify-center transition-all duration-500 ease-out translate-y-full opacity-0 opacity-100">
                                    <div class="flex flex-col justify-between h-full w-full px-4 py-2 opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full uppercase text-left"><?= $produit1->nom ?></p>
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full text-right"><?= $produit1->prix ?>€</p>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($produit2)): ?>
                            <a href="/productsItem/<?= $produit2->id_produit ?>" class="group relative block w-full scale-base md:scale-medium lg:scale-large">
                                <!-- Conteneur de l'image avec overflow-hidden -->
                                <div class="w-full h-full overflow-hidden transition-all duration-500 ease-in-out border border-color-dark">
                                <img src="<?= $produit2->img_path ?>" alt="ProTib 3" 
                                        class="h-full w-full object-cover scale-110 transition-transform duration-500 group-hover:scale-100">
                                </div>

                                <!-- Rectangle apparaissant vers le haut (gauche) -->
                                <div class="border border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-8 md:h-10 bg-color-bright flex transition-all duration-500 ease-out opacity-0 opacity-100">
                                    <!-- Sous-rectangle gauche (blanc) -->
                                    <div class="flex-1 bg-color-bright flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold text-left"><?= $produit2->categorie?></p>
                                    </div>
                                    <!-- Sous-rectangle droit (noir) -->
                                    <div class="flex-1 bg-color-dark flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-bright text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold">Discover</p>
                                    </div>
                                </div>

                                <!-- Rectangle apparaissant vers le bas (gauche) -->
                                <div class="border-x border-b border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-16 md:h-24 bg-color-bright flex items-center justify-center transition-all duration-500 ease-out translate-y-full opacity-0 opacity-100">
                                    <div class="flex flex-col justify-between h-full w-full px-4 py-2 opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full uppercase text-left"><?= $produit2->nom ?></p>
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full text-right"><?= $produit2->prix ?>€</p>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($produit3)): ?>
                            <a href="/productsItem/<?= $produit3->id_produit ?>" class="group relative block w-full scale-base md:scale-medium lg:scale-large">
                                <!-- Conteneur de l'image avec overflow-hidden -->
                                <div class="w-full h-full overflow-hidden transition-all duration-500 ease-in-out border border-color-dark">
                                  <img src="<?= $produit3->img_path ?>" alt="ProTib 3" 
                                        class="h-full w-full object-cover scale-110 transition-transform duration-500 group-hover:scale-100">
                                </div>

                                <!-- Rectangle apparaissant vers le haut (gauche) -->
                                <div class="border border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-8 md:h-10 bg-color-bright flex transition-all duration-500 ease-out opacity-0 opacity-100">
                                    <!-- Sous-rectangle gauche (blanc) -->
                                    <div class="flex-1 bg-color-bright flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold text-left"><?= $produit3->categorie?></p>
                                    </div>
                                    <!-- Sous-rectangle droit (noir) -->
                                    <div class="flex-1 bg-color-dark flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-bright text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold">Discover</p>
                                    </div>
                                </div>

                                <!-- Rectangle apparaissant vers le bas (gauche) -->
                                <div class="border-x border-b border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-16 md:h-24 bg-color-bright flex items-center justify-center transition-all duration-500 ease-out translate-y-full opacity-0 opacity-100">
                                    <div class="flex flex-col justify-between h-full w-full px-4 py-2 opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full uppercase text-left"><?= $produit3->nom?></p>
                                        <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full text-right"><?= $produit3->prix?>€</p>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>


                </div>
            </div>

            <div class="flex w-full h-full gap-64 mb-32 mt-36">

                <div class="flex flex-col gap-12 w-1/2">
                    <img src="/images/background.png" alt="" class="border border-color-dark">
                    <p class="special-font uppercase text-2xl">We honor the dedication and spirit of every athlete with our Connec'Tib shin guards. </p>
                    <p class=" text-lg">Experience protection that combines cutting-edge innovation with unmatched durability—designed to empower your every move.</p>
                    <div class="relative overflow-hidden inline-block mt-8">
                        <a href="/contact" class="group relative inline-block py-4 px-20 border border-color-dark">
                            <span class="font-extrabold relative z-10 text-[#403A34] group-hover:text-[#F6F1EB] transition duration-300">
                                MORE QUESTIONS
                            </span>
                            <div class="absolute inset-0 bg-[#403A34] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col w-2/3 justify-center">
                <!-- Bloc 1 (ouvert par défaut) -->
                <div id="block1" class="overflow-hidden bg-color-bright h-48 flex-none transition-all duration-500 ease-in-out border-x border-t border-color-dark cursor-pointer" onclick="toggleBlock(1)">
                    <div class="p-4 flex items-center justify-between">
                        <p class=" text-lg font-bold">What is it?</p>
                        <span id="arrow1" class=" text-xl transform rotate-180 transition-transform duration-300">▼</span>
                    </div>
                    <div id="content1" class="p-4 ">
                        <p>Connec'Tib shin guards are innovative, connected sports gear designed to provide superior protection while enhancing athletic performance.</p>
                    </div>
                </div>

                <!-- Bloc 2 -->
                <div id="block2" class="overflow-hidden bg-color-bright h-16 flex-none transition-all duration-500 ease-in-out border border-color-dark  cursor-pointer" onclick="toggleBlock(2)">
                    <div class="p-4 flex items-center justify-between">
                        <p class=" text-lg font-bold">Use</p>
                        <span id="arrow2" class=" text-xl transform transition-transform duration-300">▼</span>
                    </div>
                    <div id="content2" class="hidden p-4 ">
                        <p>They are designed for athletes of all levels to protect their legs during intense sports activities, offering a seamless blend of safety and technology.</p>
                    </div>
                </div>

                <!-- Bloc 3 -->
                <div id="block3" class="overflow-hidden bg-color-bright h-16 flex-none transition-all duration-500 ease-in-out border-x border-b border-color-dark cursor-pointer" onclick="toggleBlock(3)">
                    <div class="p-4 flex items-center justify-between">
                        <p class=" text-lg font-bold">Functionality</p>
                        <span id="arrow3" class=" text-xl transform transition-transform duration-300">▼</span>
                    </div>
                    <div id="content3" class="hidden p-4 ">
                        <p>Each shin guard is embedded with NFC technology, allowing athletes to access performance data, maintenance tips, and technical details through their mobile devices. </p>
                    </div>
                </div>
            </div>





            </div>
        </div>

        

    
        
        <?php
        include 'sections/footer.php';
        ?>
    </div>

    
    <script src="/js/about.js"></script>

</body>
</html>
