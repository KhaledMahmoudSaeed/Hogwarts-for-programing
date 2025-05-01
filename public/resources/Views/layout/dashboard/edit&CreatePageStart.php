<?php if ($pageType === "edit"): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit <?= $editPageName ?> • Hogwarts</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="<?= $GLOBALS['img']->style("editDashboard.css") ?>">

    </head>

    <body class="min-h-screen flex items-center justify-center p-6">

        <div class="card">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold"><i class="fas fa-hat-wizard mr-2"></i> Edit <?= $editPageName ?></h2>
            </div>
        <?php else: ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <title>Create <?= $pageName ?> • Hogwarts</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
                <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
                <link rel="stylesheet" href="<?= $GLOBALS['img']->style("editDashboard.css") ?>">

            </head>

            <body class="min-h-screen flex items-center justify-center p-6">
                <div class="card">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold"><i class="fas fa-scroll mr-2"></i>Create a <?= $pageName ?></h2>
                    </div>
                <?php endif; ?>