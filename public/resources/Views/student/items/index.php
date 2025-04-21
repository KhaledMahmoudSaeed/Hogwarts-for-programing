<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagon Alley</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=IM+Fell+English+SC&display=swap');

        body,
        html {
            font-family: 'IM Fell English SC', serif;
            margin: 0;
            padding: 0;
        }

        #diagon-alley {
            background: url('resources/assets/img/diagon-alley.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .overlay {
            flex: 1;
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
        }

        .container-all {
            background: rgba(25, 20, 20, 0.85);
            border: 2px solid goldenrod;
            border-radius: 15px;
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.4);
        }

        .header h1 {
            font-family: 'Cinzel Decorative', cursive;
            font-size: 3rem;
            color: goldenrod;
            text-shadow: 2px 2px 8px #000;
            margin-bottom: 0;
        }

        .header h2 {
            font-size: 1.5rem;
            margin-top: 0.2rem;
            color: #ddd;
            font-style: italic;
        }

        .gold-counter {
            margin-top: 1rem;
            background: #2e2a1f;
            color: red;
            padding: 0.5rem 1rem;
            border-left: 5px solid gold;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .item-card {
            background: #2e221d;
            border: 2px solid goldenrod;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 25px rgba(255, 215, 0, 0.5);
        }

        .item-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid goldenrod;
            transition: all ease 0.5s;
        }

        .item-card:hover .item-image {
            transform: rotate(-5deg) scale(1.2);
        }

        .item-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .item-name {
            font-family: 'Cinzel Decorative', cursive;
            font-size: 1.3rem;
            color: goldenrod;
            margin-bottom: 1rem;
        }

        .item-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .item-type {
            font-style: italic;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .item-price {
            font-weight: bold;
            color: goldenrod;
            margin-bottom: 1rem;
        }

        .purchase-form {
            margin-top: auto;
            display: flex;
            justify-content: flex-end;
        }

        .purchase-btn {
            background: linear-gradient(145deg, #7a6239, #9c7b4b);
            color: #fff8e1;
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.5s ease;
            font-family: 'IM Fell English SC',
                serif;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.2);
        }

        .purchase-btn:hover {
            background: #DD852D;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
            transform: scale(1.05);
        }

        i.fas {
            margin-right: 6px;
        }
    </style>

</head>

<body>
    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <section id="diagon-alley">
        <div class="overlay">
            <div class="container-all">
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