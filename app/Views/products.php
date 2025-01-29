<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connec'Tib</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/styles/global.css">
    <link rel="stylesheet" href="/styles/products.css">
</head>
<body>

    <?php
    include 'sections/header.php';
    ?>

    <div class="flex flex-col mt-32">
            
        <!-- Product & FIlter -->
        <div class="flex flex-col xl:flex-row  mx-8 gap-4 mb-48 items-between">

            <div class="flex flex-col">
                <div class="relative inline-block xl:hidden">
                    <!-- Bouton pour afficher les filtres -->
                    <a id="filters-toggle" class="group relative inline-block overflow-hidden py-4 px-12 border border-color-dark w-full text-center cursor-pointer">
                        <span class="font-extrabold relative z-10 text-[#403A34] group-hover:text-[#F6F1EB] transition duration-300">
                            FILTERS
                        </span>
                        <div class="absolute inset-0 bg-[#403A34] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                    </a>
                </div>

                <!-- Product Filter -->
                <div id="product-filter" class="hidden xl:flex xl:flex-col w-full h-fit xl:max-w-xs mx-auto border border-color-dark">
                    <!-- Barre de recherche -->
                    <div class="mb-4">
                        <input 
                            type="text" 
                            id="search" 
                            class="w-full p-4 bg-color-bright font-extrabold text-[12px] border-b border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark"
                            placeholder="SEARCH" />
                    </div>

                    <div class="p-4">
                        <!-- Cases à cocher pour filtres -->
                    <div class="mb-4">
                        <div class="space-y-2 uppercase">
                            <?php
                            foreach ($allCategorie as $cat):
                            ?>
                                <label class="flex items-center">
                                    <input type="checkbox" id="cat-1" class="appearance-none h-4 w-4 border border-color-dark bg-color-bright focus:ring-0 checked:bg-amber-950 cursor-pointer" />
                                    <span class="ml-2 text-gray-600"><?= $cat ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    
                    </div>

                    <!-- Range Selector pour le prix -->
                    <div class="">
                        <div class="flex items-center w-full ">
                            <!-- Champ Prix Min -->
                            <div class="flex items-center space-x-2 w-full">
                                <input 
                                    type="number" 
                                    id="min-price" 
                                    placeholder="MIN"
                                    class="w-full font-extrabold text-[12px] w-24 p-4 bg-color-bright border-t border-r border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                            </div>

                            <!-- Champ Prix Max -->
                            <div class="flex items-center space-x-2 w-full">
                                <input 
                                    type="number" 
                                    id="max-price" 
                                    placeholder="MAX"
                                    class="w-full font-extrabold text-[12px] w-24 p-4 bg-color-bright border-t border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                            </div>
                        </div>
                    </div>

                    

                    <!-- Bouton pour appliquer les filtres -->
                    <div>
                        <button id="apply-filters" class="hidden w-full bg-color-bright group relative overflow-hidden border-t border-color-dark py-2">
                            <span class="text-sm relative z-10 text-color-dark group-hover:text-[#F6F1EB] font-extrabold transition duration-300">APPLY</span>
                            <div class="absolute inset-0 bg-color-dark transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </button>
                    </div>
                </div>
            </div>

           


             <!-- Product List -->

            <div class="flex flex-col w-full">

                <div class="flex flex-wrap gap-x-8 gap-y-32 justify-center">
                    <?php
                    foreach ($products as $product):
                    ?>
                        <a href="/productsItem/<?= $product->id_produit ?>" class="group relative block w-full scale-base md:scale-medium lg:scale-large basis-1/2 sm:basis-1/3 md:basis-1/4 lg:basis-1/5 product-item">
                            <div class="w-full h-full overflow-hidden transition-all duration-500 ease-in-out border border-color-dark">
                                <img src="<?= $product->img_path ?>" 
                                    class="h-full w-full object-cover scale-110 transition-transform duration-500 group-hover:scale-100">
                            </div>

                            <div class="border border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-8 md:h-10 bg-color-bright flex transition-all duration-500 ease-out opacity-0 opacity-100">
                                <div class="flex-1 bg-color-bright flex items-center px-2 sm:px-4 justify-center opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                    <p class="text-color-dark text-[10px] sm:text-[12px] md:text-[14px] uppercase font-bold text-left product-category"><?= $product->categorie ?></p>
                                </div>
                            </div>

                            <div class="border-x border-b border-color-dark absolute bottom-0 left-0 h-0 w-[90%] sm:w-[80%] md:w-[70%] h-16 md:h-24 bg-color-bright flex items-center justify-center transition-all duration-500 ease-out translate-y-full opacity-0 opacity-100">
                                <div class="flex flex-col justify-between h-full w-full px-4 py-2 opacity-0 opacity-100 transition-opacity duration-300 ease-in-out">
                                    <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full uppercase text-left product-name"><?= $product->nom ?></p>
                                    <p class="text-color-dark text-sm sm:text-base md:text-lg font-bold w-full text-right product-price"><?= $product->prix ?>€</p>
                                </div>
                            </div>
                        </a>

                    <?php endforeach; ?>
                </div>

            </div>
             

        </div>
    
        
        <?php
        include 'sections/footer.php';
        ?>
    </div>

    
    <script src="/js/products.js"></script>

</body>
</html>
