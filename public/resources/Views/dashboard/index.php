<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Eagle+Lake&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../resources/assets/CSS/dashboardentry.css">
</head>

<body>
    <!-- Floating Candles -->
    <div class="floating-candles">
        <div class="candle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
        <div class="candle" style="left: 25%; top: 30%; animation-delay: 2s;"></div>
        <div class="candle" style="left: 40%; top: 15%; animation-delay: 4s;"></div>
        <div class="candle" style="left: 60%; top: 25%; animation-delay: 1s;"></div>
        <div class="candle" style="left: 75%; top: 20%; animation-delay: 3s;"></div>
        <div class="candle" style="left: 90%; top: 30%; animation-delay: 5s;"></div>
    </div>

    <header class="text-center py-12">
        <h1 class="title-text text-5xl md:text-6xl font-bold text-yellow-300 mb-4">
            <i class="fas fa-hat-wizard mr-4"></i>
            Hogwarts Control Panel
            <i class="fas fa-scroll ml-4"></i>
        </h1>
        <p class="text-gray-300 text-xl italic">
            "Draco Dormiens Nunquam Titillandus"
        </p>
    </header>

    <main class="flex flex-wrap justify-center items-center min-h-[50vh] pb-16 px-4">
        <!-- Users Portal -->
        <a href="/dashboard/users" class="m-6 w-72 h-48 portal-card flex flex-col items-center justify-center relative">
            <i class="fas fa-users portal-icon text-4xl text-yellow-300 mb-3"></i>
            <span class="text-white text-2xl font-bold">Hogwarts Register</span>
            <span class="text-gray-300 text-sm mt-2">Manage Wizards & Witches</span>
            <div class="absolute bottom-4 right-4 text-yellow-300">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <!-- Wands Portal -->
        <a href="/dashboard/wands" class="m-6 w-72 h-48 portal-card flex flex-col items-center justify-center relative">
            <i class="fas fa-magic portal-icon text-4xl text-yellow-300 mb-3"></i>
            <span class="text-white text-2xl font-bold">Wand Registry</span>
            <span class="text-gray-300 text-sm mt-2">Ollivander's Collection</span>
            <div class="absolute bottom-4 right-4 text-yellow-300">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <!-- Courses Portal -->
        <a href="/dashboard/courses"
            class="m-6 w-72 h-48 portal-card flex flex-col items-center justify-center relative">
            <i class="fas fa-book-open portal-icon text-4xl text-yellow-300 mb-3"></i>
            <span class="text-white text-2xl font-bold">Curriculum</span>
            <span class="text-gray-300 text-sm mt-2">Magical Subjects</span>
            <div class="absolute bottom-4 right-4 text-yellow-300">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <!-- Items Portal -->
        <a href="/dashboard/purchases"
            class="m-6 w-72 h-48 portal-card flex flex-col items-center justify-center relative">
            <i class="fas fa-shop portal-icon text-4xl text-yellow-300 mb-3"></i>
            <span class="text-white text-2xl font-bold">Magical Emporium</span>
            <span class="text-gray-300 text-sm mt-2">Wizarding Supplies</span>
            <div class="absolute bottom-4 right-4 text-yellow-300">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </main>

    <footer class="text-center py-6 text-gray-400 text-sm">
        <p>Hogwarts School of Witchcraft and Wizardry © 2023</p>
        <p class="mt-1">"Nitwit! Blubber! Oddment! Tweak!"</p>
    </footer>

    <!-- Animated floating parchment -->
    <div
        class="fixed bottom-4 left-4 w-16 h-16 bg-amber-100 rounded-lg opacity-80 rotate-12 animate-float-parchment hidden md:block">
        <i
            class="fas fa-quidditch absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-gray-800"></i>
    </div>
    <div
        class="fixed top-4 right-4 w-16 h-16 bg-amber-100 rounded-lg opacity-80 -rotate-12 animate-float-parchment hidden md:block">
        <i
            class="fas fa-hat-wizard absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-gray-800"></i>
    </div>
</body>

</html>