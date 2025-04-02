<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts Dashboard</title>
    <!-- Include Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font for a magical feel -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cinzel', serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[url('https://i.imgur.com/Q3z6n7L.jpg')] bg-cover bg-center">
    <header class="text-center py-8">
        <h1 class="text-5xl font-bold text-yellow-300 drop-shadow-lg">
            Welcome to Hogwarts Dashboard
        </h1>
    </header>
    <main class="flex flex-wrap justify-center items-center min-h-[calc(100vh-128px)]">
        <a href="/dashboard/users"
            class="m-4 w-64 h-40 flex items-center justify-center bg-black bg-opacity-70 border-4 border-yellow-300 rounded-xl transform hover:scale-105 transition duration-300 drop-shadow-lg">
            <span class="text-white text-2xl">Users</span>
        </a>
        <a href="/dashboard/wands"
            class="m-4 w-64 h-40 flex items-center justify-center bg-black bg-opacity-70 border-4 border-yellow-300 rounded-xl transform hover:scale-105 transition duration-300 drop-shadow-lg">
            <span class="text-white text-2xl">Wands</span>
        </a>
        <a href="/dashboard/courses"
            class="m-4 w-64 h-40 flex items-center justify-center bg-black bg-opacity-70 border-4 border-yellow-300 rounded-xl transform hover:scale-105 transition duration-300 drop-shadow-lg">
            <span class="text-white text-2xl">Courses</span>
        </a>
        <a href="/dashboard/purchases"
            class="m-4 w-64 h-40 flex items-center justify-center bg-black bg-opacity-70 border-4 border-yellow-300 rounded-xl transform hover:scale-105 transition duration-300 drop-shadow-lg">
            <span class="text-white text-2xl">Items</span>
        </a>
    </main>
</body>

</html>