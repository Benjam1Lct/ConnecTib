<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up</title>
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
<img src="/images/background.png" class="absolute top-0 left-0 w-full h-full object-cover z-[-100]"> <!-- Remplace par le chemin vers ton logo -->

<?php
    include 'sections/header.php';
    ?>

    <div class="flex items-center justify-center h-screen mb-[10vh]">
        <div class="w-full max-w-md bg-color-bright p-16">
            <h2 class="text-2xl font-bold text-gray-800 text-center">SIGN UP</h2>
            <p class="text-sm text-gray-600 text-center mb-6">Create your account to get started.</p>

            <form action="/signupForm" method="POST">
                <!-- Name -->
                <div class="">
                    <input type="text" id="name" name="name" required  placeholder="NAME"
                        class="small-text block w-full px-4 py-3 bg-color-bright border-t-[1px] border-x-[1px] border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <!-- Email -->
                <div class="">
                    <input type="email" id="email" name="email" required  placeholder="EMAIL"
                        class="small-text block w-full px-4 py-3 bg-color-bright border-t-[1px] border-x-[1px] border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <!-- Password -->
                <div class="">
                    <input type="password" id="password" name="password" required  placeholder="PASSWORD"
                        class="small-text  block w-full px-4 py-3 bg-color-bright border-t-[1px] border-x-[1px] border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <!-- Confirm Password -->
                <div class="">
                    <input type="password" id="confirm-password" name="confirm-password" required placeholder="CONFIRM  PASSWORD"
                        class="small-text  block w-full px-4 py-3 bg-color-bright border-t-[1px] border-x-[1px] border-color-dark focus:outline-none focus:ring-0 focus:border-color-dark">
                </div>

                <!-- Submit Button -->
                <div class="">
                    <button type="submit" class="w-full bg-color-dark group relative overflow-hidden border-[1px] border-color-dark py-2">
                            <span class="small-text relative z-10 text-color-bright group-hover:text-[#403A34] transition duration-300">SIGN UP</span>
                            <div class="absolute inset-0 bg-color-bright transform translate-y-full group-hover:translate-y-0 transition duration-500 ease-in-out"></div>
                        </button>
                </div>
            </form>

            <!-- Links -->
            <p class="text-sm text-gray-600 text-center mt-8">
                Already have an account? <a href="/signin" class="text-color-dark hover:underline">SIGN IN</a>
            </p>
        </div>
    </div>
</div>

    

    <?php
    include 'sections/footer.php';
    ?> 

</body>
</html>
