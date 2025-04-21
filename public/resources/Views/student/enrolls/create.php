<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Eagle+Lake&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        /* General Styles */
        body {
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") . ".gif" ?>') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            /* Magical font */
            color: #fff;
        }

        /* Container Styling */
        .container-all {
            background: rgba(0, 0, 0, 0.7);
            /* Dark overlay */
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            max-width: 600px;
            width: 90%;
        }

        /* Header Styling */
        h2 {
            font-family: 'Eagle Lake', cursive;
            /* Cursive font for title */
            font-size: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: #f7b924;
            /* Golden yellow */
            text-align: center;
        }

        /* Label Styling */
        label {
            font-size: 1rem;
            color: #f7b924;
            /* Golden yellow */
        }

        /* Dropdown Styling */
        select {
            background: rgba(255, 255, 255, 0.1);
            /* Semi-transparent background */
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 0.5rem;
            border-radius: 5px;
            width: 100%;
        }

        /* Submit Button Styling */
        .submit-btn {
            background: linear-gradient(135deg, #f7b924, #d3a625);
            font-weight: bold;
            padding: 0.5rem !important;
            font-size: 1rem !important;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #e6a819, #c2951e);
        }

        /* Back Button Styling */
        .back-btn {
            color: #f7b924 !important;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all ease 0.5s;
        }

        .back-btn:hover {
            color: #fff !important;
            background: linear-gradient(135deg, #e6a819, #c2951e) !important;
        }

        select {
            background: rgba(255, 255, 255, 0.1);
            /* Semi-transparent background */
            border: 2px solid rgba(255, 255, 255, 0.2);
            /* Subtle border */
            color: #fff;
            /* White text for dropdown */
            padding: 0.5rem;
            border-radius: 5px;
            width: 100%;
            font-family: 'Cinzel', serif;
            /* Magical font */
            font-size: 1rem;
        }

        /* Option Styling */
        select option {
            background: #000;
            /* Black background for options */
            color: #fff;
            /* White text for options */
            padding: 0.5rem;
            font-family: 'Cinzel', serif;
            /* Consistent font */
        }

        /* Hover Effect for Options */
        select option:hover {
            background: #f7b924;
            /* Golden yellow on hover */
            color: #000;
            /* Black text on hover */
        }

        /* Placeholder Styling */
        select option[value=""][disabled] {
            color: #aaa;
            /* Grayed-out placeholder text */
            font-style: italic;
            /* Italicize placeholder */
        }
    </style>
</head>

<body class=" flex flex-col items-center justify-center ">
    <?php
    ?><br>
    <div class="container-all bg-opacity-90 rounded-lg shadow-lg">
        <h2>Enroll in a New Course</h2>

        <form action="/enroll/store" method="POST" class="space-y-4">
            <input type="hidden" name="user_id" value="<?= end($data);
            array_pop($data) ?>">
            <!-- Courses Dropdown -->
            <div>
                <label class="block font-semibold">Select Course:</label>
                <select name="course_id" required
                    class="w-full mt-5 p-2 border rounded-md focus:ring focus:ring-blue-300 block font-semibold">
                    <option value="" disabled selected>-- Choose Course --</option>
                    <?php foreach ($data as $course): ?>
                        <option value="<?= htmlspecialchars($course['id']); ?>" class="dropdown-option">
                            <?= htmlspecialchars($course['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="submit-btn">
                    Enroll Course
                </button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="mt-7 text-center">
            <a href="/enrolls" class="back-btn"> Back to Your Courses</a>
        </div>
    </div>

</body>

</html>