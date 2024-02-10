<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
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
            <p>Vous retrouvez ici les derniers messages des personnes que suit Félicie (dont l'id est 123)</p>
        </aside>
        <main class="w-3/4 p-4">
            <!-- Feed items should be repeated as per the content in the screenshot -->
            <div class="mb-4">
                <div class="flex justify-between mb-2">
                    <span class="text-xs">1 décembre 2020, 11h12</span>
                    <span class="text-xs">par Alexandra</span>
                </div>
                <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <div>
                    <span class="text-xs bg-gray-300 p-1 mr-1">#lorem</span>
                    <span class="text-xs bg-gray-300 p-1">#adipiscing</span>
                </div>
            </div>
            <!-- Repeat the above block for each feed item, changing the date, author, and content accordingly. -->
        </main>
    </div>
</body>

</html>
