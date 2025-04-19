<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagon Alley</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <section id="diagon-alley">
        <div class="overlay">
            <div class="container">
                <div class="header">
                    <h1><i class="fas fa-hat-wizard"></i> Diagon Alley</h1>
                    <h2>Magical Items & Artifacts</h2>

                    <?php if (isset($_SESSION['money'])): ?>
                        <div class="gold-counter">
                            <i class="fas fa-coins"></i>
                            <span>Your Gringotts Balance: <?php echo htmlspecialchars($_SESSION['money']); ?>
                                Galleons</span>
                        </div>
                        <?php unset($_SESSION['money']); ?>
                    <?php endif; ?>
                </div>

                <div class="items-grid">
                    <?php foreach ($data as $item): ?>
                        <div class="item-card">
                            <img src="<?= $GLOBALS['img']->image($item['img'], "items") ?>"
                                alt="<?= htmlspecialchars($item['name']) ?>" class="item-image">
                            <div class="item-content">
                                <h3 class="item-name"><?= htmlspecialchars($item['name']) ?></h3>
                                <div class="item-meta">
                                    <span class="item-type"><?= htmlspecialchars($item['type']) ?></span>
                                    <span class="item-price">
                                        <?= htmlspecialchars($item['price']) ?> <i class="fas fa-coins"></i>
                                    </span>
                                </div>
                                <form action="/diagon-alley" method="POST" class="purchase-form">
                                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                    <input type="hidden" name="price" value="<?= htmlspecialchars($item['price']) ?>">
                                    <button type="submit" class="purchase-btn">
                                        <i class="fa-solid fa-wand-sparkles"></i> Accio
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>