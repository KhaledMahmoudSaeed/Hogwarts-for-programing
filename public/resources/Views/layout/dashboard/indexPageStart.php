<?php
$paginationData = $GLOBALS['function']->pagination($data);
$pageData = $paginationData['pageData'];
$currentPage = $paginationData['currentPage'];
$totalPages = $paginationData['totalPages'];
$offset = $paginationData['offset'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts <?= $tableName ?> Dashboard</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Magical Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("indexDashboard.css") ?>">

</head>

<body class="flex flex-col items-center pt-10">
    <div class="w-full max-w-7xl px-6">
        <div class="hogwarts-card p-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-yellow-300 flex items-center">
                    <i class="fas fa-hat-wizard mr-3"></i> Hogwarts <?= $tableName ?>
                </h1>
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    <a href="/dashboard" class="hogwarts-button glow-hover flex items-center"><i
                            class="fas fa-undo mr-2"></i>Back to dashboard</a>
                    <?php if ($tableName !== "Users"): ?>
                        <?php $tableName = substr($tableName, 0, -1); ?>
                        <a href="/dashboard/<?= $url ?>/create" class="hogwarts-button glow-hover flex items-center"><i
                                class="fas fa-plus mr-2"></i>Add
                            <?= $tableName ?></a>
                    <?php endif ?>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>