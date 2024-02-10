<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-200">
    <nav class="bg-white p-4 flex justify-between items-center border-b-2 border-gray-300">
        <div class="flex items-center">
            <i class="fas fa-bars mr-4"></i>
            <img src="https://placehold.co/40x40" alt="ReSoc logo placeholder" class="mr-2">
            <span class="font-semibold">ReSoc</span>
        </div>
        <div class="space-x-4">
            <a href="#" class="hover:text-gray-700">Actualités</a>
            <a href="#" class="hover:text-gray-700">Mur</a>
            <a href="#" class="hover:text-gray-700">Flux</a>
            <a href="#" class="hover:text-gray-700">Mots-clés</a>
        </div>
        <div>
            <i class="fas fa-user mr-2"></i>
            <i class="fas fa-chevron-down"></i>
        </div>
    </nav>

    <div class="flex">
        <main class="w-full p-4">
            <div class="flex justify-between">
                <section class="w-1/2 pr-2">
                    <h2 class="font-bold text-xl mb-4">Utilisateurs</h2>
                    <!-- User rows should be repeated as per the content in the screenshot -->
                    <div class="mb-4 border-2 border-black p-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">Félicie</span>
                            <span>id:123</span>
                        </div>
                        <div class="grid grid-cols-5 gap-2">
                            <span class="border-2 border-black p-1 text-center">Mur</span>
                            <span class="border-2 border-black p-1 text-center">Flux</span>
                            <span class="border-2 border-black p-1 text-center">Paramètres</span>
                            <span class="border-2 border-black p-1 text-center">Suiveurs</span>
                            <span class="border-2 border-black p-1 text-center">Abonnements</span>
                        </div>
                    </div>
                    <!-- Repeat the above block for each user, changing the name and id accordingly. -->
                </section>

                <section class="w-1/2 pl-2">
                    <h2 class="font-bold text-xl mb-4">Mots clés</h2>
                    <!-- Keyword rows should be repeated as per the content in the screenshot -->
                    <div class="mb-4 border-2 border-black p-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">Lorem</span>
                            <span>id:996</span>
                        </div>
                        <div class="text-right">
                            <span class="border-2 border-black p-1">Messages</span>
                        </div>
                    </div>
                    <!-- Repeat the above block for each keyword, changing the word and id accordingly. -->
                </section>
            </div>
        </main>
    </div>
</body>

</html>
