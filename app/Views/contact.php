<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/global.css">
    <title>Contact Us</title>
</head>
<body class="flex flex-col min-h-screen">

    <?php include 'sections/header.php'; ?>

    <main class="flex-grow">
        <div class="relative h-[100vh]">
            <img src="images/background.png" alt="Background" class="w-full h-full object-cover">
            
            <div class="absolute bottom-[2rem] left-[2rem] w-full max-x-md bg-color-bright border border-black text-sm shadow-md max-w-xs">
                <div class="border-b border-color-dark p-4 flex items-end text-[14px]">
                    <h3 class="special-font font-bold uppercase  ">Informations</h3>
                </div>
                <div class="flex flex-col p-4 text-[14px] space-y-4">
                    <div class="flex flex-col">
                        <p class="font-bold special-font">CONNEC'TIB</p>
                        <p class="text-[12px]">123 AVENUE DES CHAMPS-ÉLYSÉES<br>44000 NANTES, France</p>
                    </div>
                    <p class="font-bold special-font">+33 6 12 34 56 78</p>
                    <p class="font-bold special-font uppercase">contact@connectib.com</p>
                </div>
                
            </div>
        </div>

        <div class="w-full py-32 bg-color-bright">
            <div class="max-w-2xl mx-auto bg-color-bright p-8 border border-color-dark text-[14px] px-16">
                <h2 class="text-3xl font-bold text-gray-800 text-center mb-6 uppercase special-font py-8">Get In Touch</h2>

                <form action="#" method="POST">
                    <div class="mb-0">
                        <input type="text" id="subject" name="subject" required placeholder="SUBJECT"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark"">
                    </div>

                    <div class="grid grid-cols-2">
                        <input type="text" id="first_name" name="first_name" required placeholder="FIRST NAME"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border-l border-l border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark">
                        <input type="text" id="last_name" name="last_name" required placeholder="LAST NAME"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border-l border- border-r border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark">
                    </div>

                    <div class="grid grid-cols-3">
                        <input type="number" id="phone" name="phone" placeholder="PHONE"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border-l border-t border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark">
                        <input type="text" id="address" name="address" placeholder="ADDRESS"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border-l border-t border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark">
                        <input type="email" id="email" name="email" required placeholder="EMAIL"
                            class="placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border-l border-r border-t border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark">
                    </div>

                    <div class="mt-0">
                        <textarea id="message" name="message" required placeholder="YOUR MESSAGE"
                            class="resize-none placeholder-yellow-950 block w-full px-4 py-3 bg-color-bright border border-black rounded-none focus:outline-none focus:ring-0 focus:border-color-dark"
                            rows="6"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="mb-8 w-full bg-color-dark group relative overflow-hidden border-[1px] border-color-dark py-4">
                            <span class="relative z-10 text-color-bright group-hover:text-[#403A34] transition duration-300">SEND</span>
                            <div class="absolute inset-0 bg-color-bright transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'sections/footer.php'; ?>

</body>
</html>
