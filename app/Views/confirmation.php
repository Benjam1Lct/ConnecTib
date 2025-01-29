<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body>
    <?php include 'sections/header.php'; ?>
    
    <div class="container mx-auto mt-48 h-[100vh]">
        <h1 class="text-3xl font-bold text-center mb-10 uppercase special-font">billing confirmation</h1>
        <p class="text-center text-green-600 font-semibold">
            <?= esc($message) ?>
        </p>
        <div class="flex justify-center mt-10">
            <a href="/products" type="submit" id="filters-toggle" class="w-full max-w-sm flex items-center justify-center border border-color-dark bg-color-dark group relative inline-block overflow-hidden py-6 px-12 w-full text-center cursor-pointer">
                <span class="font-extrabold special-font text-lg relative z-10 text-[#F6F1EB] group-hover:text-[#403A34] transition duration-300">
                Home
                </span>
                <div class="absolute inset-0 bg-[#F6F1EB] transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
            </a>
        </div>

        
    </div>
    <?php include 'sections/footer.php'; ?>
</body>
</html>
