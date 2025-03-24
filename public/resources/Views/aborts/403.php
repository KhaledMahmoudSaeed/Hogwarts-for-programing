<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-[#1a1a1a] text-white font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Shield Container -->
        <div class="bg-[#0e1a40] p-8 rounded-lg shadow-2xl relative max-w-md w-full">
            <!-- House Flags as Borders -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#740001] via-[#1a472a] to-[#0e1a40]">
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-[#ffdb00] via-[#946b2d] to-[#2a623d]">
            </div>

            <!-- Shield Icon -->
            <div class="text-6xl text-[#ffdb00] mb-4 animate-glow">
                <i class="fas fa-shield-alt"></i>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-[#ffdb00] mb-4">403</h1>
            <p class="text-lg text-[#d3d3d3] mb-4">Access Denied! You shall not pass!</p>
            <p class="text-sm text-[#d3d3d3] mb-6">Only those with proper clearance may proceed.</p>

            <!-- Return Button -->
            <a href="/"
                class="bg-[#ffdb00] text-[#0e1a40] px-6 py-2 rounded-lg font-semibold hover:bg-[#e6c200] transition duration-300">
                Go Back to Safety
            </a>
        </div>
    </div>

    <!-- Glowing Animation -->
    <style>
        @keyframes glow {

            0%,
            100% {
                text-shadow: 0 0 10px rgba(255, 219, 0, 0.8);
            }

            50% {
                text-shadow: 0 0 20px rgba(255, 219, 0, 0.8);
            }
        }

        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }
    </style>
</body>

</html>