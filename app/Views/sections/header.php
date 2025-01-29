<?php
    session();
    $isLoggedIn = isset($_SESSION['user']);
    
    $idUser = $_SESSION['user']['id'] ?? null;

    use App\Models\ProcedureModel;

    $procedureModel = new ProcedureModel();
    $produits = $procedureModel->getAllModel('Produit', \App\Entities\Produit::class);

    // Vérifier qu'il y a au moins 3 produits et récupérer les derniers
    $produit1 = $produits[count($produits) - 1] ?? null;
    $produit2 = $produits[count($produits) - 2] ?? null;
    $produit3 = $produits[count($produits) - 3] ?? null;

    $paniers = $procedureModel->getAllModel('Panier', \App\Entities\Panier::class);
    $panierId = 0;

    // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
    foreach ($paniers as $panier) {
        // Si l'ID utilisateur correspond
        if ($panier->id_utilisateur == $idUser) {
            // Retourner l'ID du panier
            $panierId = $panier->id_panier;
        }
    }
    $produitUser = []; 

    $panierproduits  = $procedureModel->getAllModel('PanierProduit', \App\Entities\PanierProduit::class);
    // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
    foreach ($panierproduits as $produit) {
        // Si l'ID utilisateur correspond
        if ($produit->id_panier == $panierId) {
            // Retourner l'ID du panier
            $produitUser[] = $produit;
        }
    }

    $nbProduitsPanier = count($produitUser);        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/styles/global.css" rel="stylesheet" />
    <link href="/styles/header.css" rel="stylesheet" />
</head>
<body class="p-0 m-0 bg-color-bright h-[100vh] flex flex-col min-h-screen overflow-x-hidden">

    <!-- Header -->
    <header class="z-[1000] bg-color-bright text-color-dark border-[1px] border-[#403A34] w-[calc(100%-4rem)] m-[2rem] fixed">
        <nav id="desktop-nav" class="flex h-[45px] md:h-[55px]">
            <!-- Logo -->
            <a href="/" id="title-button-nav" class="text-l px-6 border-r-[1px] border-[#403A34] flex items-center">Connec'Tib</a>
            <div id="dropdown-trigger" class="relative text-[12px] font-bold border-r-[1px] border-[#403A34] flex items-center px-24 cursor-pointer group">
                <!-- Dropdown Trigger -->
                <p id="" class="relative flex z-10">
                    <span id="trigger-text" class="text-color-dark group-hover:opacity-0 transition-opacity duration-300 ease-in-out">PRODUCTS</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform transform rotate-180 group-hover:opacity-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" id="dropdown-arrow1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </p>
                <div class="absolute inset-0 bg-color-dark transform scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 ease-in-out"></div>
                <p class="absolute inset-0 flex items-center justify-center text-[#F6F1EB] opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                    PRODUCTS
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform transform rotate-180 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" id="dropdown-arrow2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </p>
            </div>
            <!-- Dropdown Menu -->
            <ul class="flex justify-between absolute left-[-1px] text-[12px] font-bold top-full bg-color-bright border-[1px] border-[#403A34] dropdown-width hidden z-50" id="dropdown-menu">
                <div class="flex flex-col uppercase pt-3">
                    <li class="relative w-full">
                        <a id="navDropmenuText-1" data-image="navDropmenuImage-1" href="/products" class="block px-8 py-3">ALL OUR PRODUCTS</a>
                    </li>
                    <li class="relative">
                        <a id="navDropmenuText-2" data-image="navDropmenuImage-2"  href="/productsItem/<?php echo($produit1->id_produit) ?>" class="block px-8 py-3"><?php echo($produit1->nom) ?></a>
                    </li>
                    <li class="relative">
                        <a id="navDropmenuText-3" data-image="navDropmenuImage-3"  href="/productsItem/<?php echo($produit2->id_produit) ?>" class="block px-8 py-3"><?php echo($produit2->nom) ?></a>
                    </li>
                    <li class="relative">
                        <a id="navDropmenuText-4" data-image="navDropmenuImage-4"  href="/productsItem/<?php echo($produit3->id_produit) ?>" class="block px-8 py-3"><?php echo($produit3->nom) ?></a>
                    </li>
                </div>
                <div class="flex flex-col w-72 h-72">
                    <img id="navDropmenuImage-1" src="/images/tenue.png" alt="" class="w-full h-full object-cover">
                    <img id="navDropmenuImage-2" src="<?php echo($produit1->img_path) ?>" alt="" class="w-full h-full object-cover hidden">
                    <img id="navDropmenuImage-3" src="<?php echo($produit2->img_path) ?>" alt="" class="w-full h-full object-cover hidden">
                    <img id="navDropmenuImage-4" src="<?php echo($produit3->img_path) ?>" alt="" class="w-full h-full object-cover hidden">
                </div>
                
            </ul>


            <!-- Navigation Menu -->
            <ul class="flex ml-auto divide-x-[1px]   divide-[#403A34]">
                <li class="px-4 h-full flex ">
                </li>
                <li class="h-full flex items-center relative group">
                    <!-- Rectangle animé derrière -->
                    <div class="absolute inset-0 bg-color-dark transform scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 ease-in-out z-0"></div>
                    <!-- Lien et texte -->
                    <a href="/about" class="px-4 flex items-center w-full h-full relative text-[12px] font-bold text-color-dark group-hover:text-[#F6F1EB] transition duration-300 z-10">
                        ABOUT
                    </a>
                </li>
                
                <li class="h-full flex items-center relative group">
                    <!-- Rectangle animé derrière -->
                    <div class="absolute inset-0 bg-color-dark transform scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 ease-in-out z-0"></div>
                    <!-- Lien et texte -->
                    <?php if ($isLoggedIn): ?>
                        <!-- Profil button -->
                        <a href="/profil" class="px-4 flex items-center w-full h-full relative text-[12px] font-bold text-color-dark group-hover:text-[#F6F1EB] transition duration-300 z-10">
                            PROFIL
                        </a>
                    <?php else: ?>
                        <!-- Sign In button -->
                        <a href="/signin" class="px-4 flex items-center w-full h-full relative text-[12px] font-bold text-color-dark group-hover:text-[#F6F1EB] transition duration-300 z-10">
                            SIGN IN
                        </a>
                    <?php endif; ?>
                </li>
                <li class="h-full flex items-center relative group">
                <!-- Rectangle animé derrière -->
                <div class="absolute inset-0 bg-color-dark transform scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 ease-in-out z-0"></div>

                <!-- Lien et texte -->
                <a href="/cart" class="px-8 flex items-center w-full h-full relative text-[12px] font-bold text-color-dark group-hover:text-[#F6F1EB] transition duration-300 z-10">
                    CART
                </a>

                <!-- Rectangle avec le nombre d'items -->
                <div class="absolute top-0 right-0 transform translate-x -translate-y bg-color-dark text-[#F6F1EB] text-[9px] font-bold px-1.5 py-[2px]">
                    <?php echo($nbProduitsPanier) ?>
                </div>
                </li>


            </ul>
        </nav>


        <!-- Mobile Navigation -->
        <nav id="mobile-nav" class="flex justify-between h-[50px]">
            <!-- Logo -->
            <a href="/" id="title-button-nav" class="text-xl px-6 border-r-[1px] border-[#403A34] flex items-center">Connec'Tib</a>
            <div id="dropdown-trigger-mobile" class="relative text-[14px] font-bold border-r-[1px] border-[#403A34] flex items-center justify-center w-full px-20 cursor-pointer group">
                <!-- Dropdown Trigger -->
                <p id="textDropTriggerMobile" class="relative flex z-10">
                    MENU
                </p>
            </div>
            


            <!-- Navigation Menu -->
            <ul class="flex ml-auto divide-x-[1px]   divide-[#403A34]">
                <li class="px-8 h-full flex items-center relative group">
                <!-- Rectangle animé derrière -->
                <div class="absolute inset-0 bg-color-dark transform scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 ease-in-out z-0"></div>

                <!-- Lien et texte -->
                <a href="/cart" class="relative text-[14px] font-bold text-color-dark group-hover:text-[#F6F1EB] transition duration-300 z-10">
                    CART
                </a>

                <!-- Rectangle avec le nombre d'items -->
                <div class="absolute top-0 right-0 transform translate-x -translate-y bg-color-dark text-[#F6F1EB] text-[9px] font-bold px-1.5 py-[2px]">
                    <?php echo($nbProduitsPanier) ?>
                </div>
                </li>


            </ul>
        </nav>

        <div id="dropdown-menu-mobile" class="absolute left-[-1px] hidden bg-color-bright border-[1px] border-[#403A34] dropdown-width">
            <!-- Text Block -->
            <a href="/products" class="px-6 py-4 border-b-[1px] border-[#403A34] flex justify-center">
                <p class="text-[14px] font-bold text-color-dark">All PRODUCTS</p>
            </a>

            <!-- Link Blocks -->
            <div class="border-b-[1px] border-[#403A34] flex justify-center">
                <a href="/about" class="px-6 py-4 w-full h-full flex items-center justify-center block text-[14px] font-bold text-color-dark ">ABOUT</a>
            </div>
            <div class=" flex justify-center">
                <?php if ($isLoggedIn): ?>
                    <!-- Profil button -->
                    <a href="/profil" class="px-6 py-4 w-full h-full flex items-center justify-center text-[14px] font-bold text-color-dark ">PROFIL</a>
                <?php else: ?>
                    <!-- Sign In button -->
                    <a href="/signin" class="px-6 py-4 w-full h-full flex items-center justify-center text-[14px] font-bold text-color-dark ">SIGN IN</a>
                <?php endif; ?>
            </div>
        </div>
        
    </header>

    <script src="/js/header.js"></script>
    <script src="/js/header-mobile.js"></script>

</body>
</html>
