<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-[#1a1a1a] text-white font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Parchment Background -->
        <div class="bg-[#f5f5dc] text-[#3e3e3e] p-8 rounded-lg shadow-2xl relative max-w-md w-full">
            <!-- House Flags as Borders -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#740001] via-[#1a472a] to-[#0e1a40]">
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-[#ffdb00] via-[#946b2d] to-[#2a623d]">
            </div>

            <!-- Quill Icon -->
            <div class="text-6xl text-[#740001] mb-4 animate-float">
                <i class="fas fa-feather-alt"></i>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-[#740001] mb-4">404</h1>
            <p class="text-lg text-[#3e3e3e] mb-4">Merlin's beard! The page you're looking for has vanished.</p>
            <p class="text-sm text-[#3e3e3e] mb-6">Perhaps it's hidden in the Room of Requirement?</p>

            <!-- Return Button -->
            <a href="/"
                class="bg-[#740001] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#5a0001] transition duration-300">
                Return to Hogwarts
            </a>
        </div>
    </div>

    <!-- Floating Animation -->
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</body>

</html>