<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Félicie's Followers</title>
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
        <aside class="w-1/4 bg-white p-4 border-r-2 border-gray-300">
            <img src="https://placehold.co/100x100" alt="Portrait de Félicie" class="mb-4">
            <p>Vous retrouvez ici la liste des personnes qui suivent les messages de Félicie, dont l'id est 123</p>
            <ul class="mt-4">
                <li class="mb-2"><a href="#" class="text-blue-600 hover:text-blue-800">Paramètres</a></li>
                <li class="mb-2"><a href="#" class="text-blue-600 hover:text-blue-800">Mes suiveurs</a></li>
                <li class="mb-2"><a href="#" class="text-blue-600 hover:text-blue-800">Mes abonnements</a></li>
            </ul>
        </aside>
        <main class="w-3/4 p-4 grid grid-cols-3 gap-4">
            <!-- Follower items should be repeated as per the content in the screenshot -->
            <div class="border-2 border-black p-2 text-center">
                <img src="https://placehold.co/80x80" alt="Béatrice profile placeholder" class="mb-2 mx-auto">
                <p>Béatrice</p>
            </div>
            <div class="border-2 border-black p-2 text-center">
                <img src="https://placehold.co/80x80" alt="Cécile profile placeholder" class="mb-2 mx-auto">
                <p>Cécile</p>
            </div>
            <div class="border-2 border-black p-2 text-center">
                <img src="https://placehold.co/80x80" alt="Charlotte profile placeholder" class="mb-2 mx-auto">
                <p>Charlotte</p>
            </div>
            <!-- Repeat the above block for each follower, changing the name and placeholder image alt text accordingly. -->
        </main>
    </div>
</body>

</html>
