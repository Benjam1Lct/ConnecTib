<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connec'Tib</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/styles/global.css">
    <link rel="stylesheet" href="/styles/about.css">
</head>
<body>

    <?php
    include 'sections/header.php';
    ?>

    <!-- Contenu principal -->
    <main class="flex flex-col flex-grow mx-8 items-center mt-44">
        <div class="title-variable">
            <!-- Chaque lettre dans un <span> -->
            <span>C</span>
            <span>O</span>
            <span>N</span>
            <span>N</span>
            <span>E</span>
            <span>C</span>
            <span>'</span>
            <span>T</span>
            <span>I</span>
            <span>B</span>
        </div>

        <div class="flex flex-col items-center w-full mt-16">
            <div class="flex flex-col items-left w-full max-w-lg gap-4">
                <p class="font-extrabold text-[14px] uppercase">
                Connec'Tib, a French company proudly based in the heart of France, redefines sports protection with cutting-edge, connected technology.
                </p>
                <p class="text-[12px]">
                Our innovative shin guards combine advanced performance tracking with superior comfort, offering athletes a seamless blend of protection and precision. Crafted with care, each product embodies French excellence and modern design, ensuring durability and style on and off the field.
                </p>
                <p class="text-[12px]">
                At Connec'Tib, we’re committed to empowering athletes of all levels to push their limits while staying connected to their performance.
                </p>
            </div>
        </div>

        <!-- rectangle 1-->
        <div class="flex justify-left w-full mt-44 parent-container" id="parent1">
            <div id="sticky-rectangle" class="sticky-rectangle flex flex-col items-left justify-between gap-16 border border-color-dark p-4 w-[15rem] h-[15rem] text-nowrap">
                <p id="rectangle-number" class="font-extrabold">01</p>
                <p  id="rectangle-text" class="font-extrabold">
                    OUR CONCEPT
                </p>
            </div>
            <div id="sticky-rectangle-box" class="opacity-0 hidden sticky-rectangle flex flex-col items-left justify-between gap-16 border border-color-dark p-4 w-[15rem] h-[15rem] text-nowrap">
                <p class="font-extrabold">01</p>
                <p class="font-extrabold">
                    OUR CONCEPT
                </p>
            </div>
            <div class="flex flex-col items-left gap-8 pl-32 w-[calc(100%-15rem)] content-section">
                <p class="font-extrabold text-4xl uppercase">Innovative, Connected and Tailored Protection</p>
                
                <div class="flex w-full justify-between gap-8">
                    <div class="flex flex-col w-full max-w-xl h-fill gap-8">
                        <p class="text-[14px] font-bold uppercase">
                        Protection: a concept that embodies both innovation and safety. Connec'Tib: a breakthrough in sports gear, designed to seamlessly blend durability and performance.
                        </p>
                        <div class="flex gap-4">
                            <p class="text-[12px]">
                            Connec'Tib is a testament to progress. Every shin guard we create carries a commitment to empower athletes, combining advanced protection with state-of-the-art technology. Crafted with precision, our shin guards offer not only unparalleled safety but also a connection to your performance metrics in real-time.
                            </p>
                            <p class="text-[12px]">
                            To preserve their uniqueness, we integrate innovative materials that ensure maximum comfort and endurance. Each Connec'Tib shin guard is embedded with NFC technology, providing athletes with instant access to technical details, performance insights, and maintenance tips through their mobile devices.
                            </p>
                        </div>
                    </div>

                    <img src="/images/imageCarre.png" alt="" class="hidden xl:block w-[20rem] h-[20rem]">
                </div>
                
                
            </div>
        </div>


        <!-- rectangle 2-->
        <div class="flex justify-left w-full mt-32 parent-container" id="parent2">
            <div class="opacity-0 flex flex-col items-left justify-between gap-16 border border-color-dark p-4 w-[15rem] h-[15rem] text-nowrap">
                <p class="font-extrabold">02</p>
                    <p class="font-extrabold">
                    OUR PHILOSOPHY
                </p>
            </div>
            <div class="flex flex-col items-left gap-8 pl-32 w-[calc(100%-15rem)] content-section">
                <p class="font-extrabold text-4xl uppercase">Performance and Eco-Responsibility</p>
                <div class="flex w-full justify-between gap-8">
                    <div class="flex flex-col w-full max-w-xl gap-8">
                        <p class="text-[14px] font-bold uppercase">
                        Connec'Tib is a product of its time, addressing the evolving needs of modern athletes while responding to the growing demand for sustainable solutions.                        </p>
                        <div class="flex gap-4">
                            <p class="text-[12px]">
                            Our commitment to eco-conscious production ensures that every shin guard is crafted using durable, high-quality materials, designed to minimize environmental impact. This careful balance between cutting-edge technology and responsible manufacturing reflects our dedication to creating gear that empowers athletes without compromising the planet.                            </p>
                            <p class="text-[12px]">
                            We believe in personalization as a cornerstone of excellence. At Connec'Tib, the athlete is at the heart of the creation process. From your first interaction with us, we listen closely to your needs, tailoring your shin guards to your unique aspirations. This collaborative approach allows us to deliver not just sports gear but a personalized solution that combines protection, performance, and style.                            </p>
                        </div>
                    </div>

                    <img src="/images/imageCarre.png" alt="" class="hidden xl:block w-[20rem] h-[20rem]">

                </div>
                
                
            </div>
        </div>


        <!-- rectangle 3-->
        <div class="flex justify-left w-full my-32 parent-container" id="parent3">
            <div id="sticky-rectangle-last" class=" opacity-0 flex flex-col items-left justify-between gap-16 border border-color-dark p-4 w-[15rem] h-[15rem] text-nowrap">
                <p class="font-extrabold">03</p>
                <p class="font-extrabold">
                    COMMITMENT
                </p>
            </div>
            <div class="flex flex-col items-left gap-8 pl-32 w-[calc(100%-15rem)] content-section">
                <p class="font-extrabold text-4xl uppercase">Responsible and Ethical Approach</p>
                <div class="flex w-full justify-between gap-8">
                    <div class="flex flex-col w-full max-w-xl gap-8">
                        <p class="text-[14px] font-bold uppercase">
                        At Connec'Tib, we are redefining athletic gear with a deep commitment to sustainability and responsibility. Through our connected shin guards, we showcase an eco-conscious approach that balances advanced technology with environmental stewardship.                        <div class="flex gap-4">
                            <p class="text-[12px]">
                            We prioritize minimizing the impact of new material production by integrating sustainable practices into every stage of our process. Our materials are carefully selected to ensure durability while reducing waste, and we are committed to sourcing from suppliers who adhere to ethical and responsible production standards.                            
                            <p class="text-[12px]">
                            Our mission extends beyond creating premium sports gear; we aim to inspire athletes and the industry at large to embrace a future rooted in sustainability and respect for the environment. By championing quality, innovation, and ecological responsibility, Connec'Tib is not just protecting players on the field but also contributing to the protection of our planet.                        </div>
                    </div>
                    
                    <img src="/images/imageCarre.png" alt="" class="hidden xl:block w-[20rem] h-[20rem]">
                </div>
                
                

            </div>
        </div>

        <div class="flex w-full h-full gap-64 mb-64">

            <div class="flex flex-col gap-12 w-1/2">
                <img src="/images/background.png" alt="" >
                <p class="special-font uppercase text-2xl">We honor the dedication and spirit of every athlete with our Connec'Tib shin guards.</p>
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
    </main>

    
    <?php
    include 'sections/footer.php';
    ?>

    <script src="/js/about.js"></script>

</body>
</html>
