<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Diagon Alley</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=IM+Fell+English+SC&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">


    <style>
        :root {
            --gold: #d4af37;
            --bg-dark: #2e221d;
            --text-light: #fdf6e3;
        }

        #diagon-alley {
            background: url('resources/assets/img/diagon-alley.png') center/cover fixed no-repeat;
            min-height: 100vh;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
        }

        .overlay {
            flex: 1;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .container-all {
            position: relative;
            background: rgba(25, 20, 20, 0.5);
            border: 3px solid var(--gold);
            border-radius: 20px;
            max-width: 1000px;
            margin: 4rem auto;
            padding: 2rem;
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.8),
                0 0 40px rgba(212, 175, 55, 0.6);
        }

        .header h1 {
            font-size: 3rem;
            color: var(--gold);
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.7);
            margin: 0;
        }

        .header h2 {
            font-size: 1.5rem;
            color: #ddd;
            font-style: italic;
            margin-top: 0.2rem;
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.8);
        }

        .gold-counter {
            width: 100%;
            margin: 1rem 0;
            background: #2e2a1f;
            padding: 0.5rem 1rem;
            border-left: 5px solid var(--gold);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
        }

        .search-bar {
            position: relative;
            margin: 2rem auto;
            max-width: 500px;
        }

        .search-bar input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 3rem;
            border: 2px solid var(--gold);
            border-radius: 30px;
            background: rgb(25, 20, 20);
            font-size: 1.1rem;
            caret-color: var(--gold);
            color: var(--text-light);
            box-shadow: 0 0 15px rgba(211, 166, 37, 0.5);
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            outline: none;
            box-shadow: 0 0 20px rgba(211, 166, 37, 0.8),
                inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .search-bar .fa-search {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            font-size: 1.2rem;
        }

        .category-section {
            margin-top: 3rem;
        }

        .category-title {
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.7);
        }

        .slider-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .scroll-btn {
            background: rgba(0, 0, 0, 0.7);
            color: var(--gold);
            border: 2px solid var(--gold);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 2;
        }

        .scroll-btn:hover {
            background: var(--gold);
            color: #2e221d;
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.8),
                0 0 20px rgba(212, 175, 55, 0.6);
        }

        .slider {
            flex: 1;
            display: flex;
            gap: 1.5rem;
            overflow: hidden;
            scroll-behavior: smooth;
            padding: 0.5rem;
        }

        .item-card {
            position: relative;
            background: linear-gradient(145deg, #3e2c20, #251a13);
            border: 3px solid var(--gold);
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-width: 250px;
            min-height: 400px;
            animation: float 5s ease-in-out infinite;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .item-card:hover {
            transform: scale(1.01) translateY(-2px) !important;
            box-shadow: 0 0 8px rgba(212, 175, 55, 0.8),
                0 0 10px rgba(212, 175, 55, 0.5);
            animation-play-state: paused;
        }

        .item-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 3px solid var(--gold);
            transition: transform 0.6s ease;
        }

        .item-card:hover .item-image {
            transform: rotate(-3deg) scale(1.12);
        }

        .item-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .item-text {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
        }

        .item-name {
            text-align: center;
            font-size: 1.3rem;
            color: var(--gold);
            margin: 1rem 0;
            text-shadow: 1px 1px 4px #000;
            position: relative;
        }

        .item-name::after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .item-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
        }

        .item-type {
            font-style: italic;
            color: var(--text-light);
        }

        .item-price {
            font-weight: bold;
            color: var(--gold);
        }

        .purchase-btn {
            background: linear-gradient(145deg, #8b5e3c, #b18855);
            color: #fff8e1;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
            transition: transform 0.5s ease, box-shadow 0.5s ease, background 0.5s ease;
        }

        .purchase-btn:hover {
            background: var(--gold);
            color: var(--bg-dark);
            transform: translateY(-2px) scale(1.1);
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.9),
                0 0 15px rgba(212, 175, 55, 0.7);
        }
    </style>
</head>

<body>
    <?php require __DIR__ . "/../../layout/navbar.view.php"; ?>

    <section id="diagon-alley">
        <div class="overlay">
            <div class="container-all">
                <div class="header">
                    <h1><i class="fas fa-hat-wizard"></i> Diagon Alley</h1>
                    <h2>Magical Items & Artifacts</h2>
                    <?php if (isset($_SESSION['money'])): ?>
                        <div class="gold-counter">
                            <i class="fas fa-coins"></i>
                            <span>Your Balance: <?= htmlspecialchars($_SESSION['money']) ?> Galleons</span>
                        </div>
                        <?php unset($_SESSION['money']); ?>
                    <?php endif; ?>

                    <div class="search-bar">
                        <input type="text" id="item-search" placeholder="Search items…">
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <?php
                $categories = [];
                foreach ($data as $item) {
                    $categories[$item['type']][] = $item;
                }
                ?>

                <?php foreach ($categories as $type => $items): ?>
                    <div class="category-section" data-category="<?= $type ?>">
                        <h3 class="category-title"><?= $type ?></h3>
                        <div class="slider-wrapper">
                            <button class="btn scroll-btn left"><i class="fas fa-chevron-left"></i></button>
                            <div class="slider">
                                <?php foreach ($items as $item): ?>
                                    <div class="item-card" data-name="<?= strtolower($item['name']) ?>">
                                        <img src="<?= $GLOBALS['img']->image($item['img'], 'items') ?>"
                                            alt="<?= $item['name'] ?>" class="item-image">
                                        <div class="item-content">
                                            <div class="item-text">
                                                <h3 class="item-name"><?= $item['name'] ?></h3>
                                                <div class="item-meta">
                                                    <span class="item-type"><?= $item['type'] ?></span>
                                                    <span class="item-price"><?= $item['price'] ?> <i
                                                            class="fas fa-coins"></i></span>
                                                </div>
                                            </div>
                                            <form action="/diagon-alley" method="POST">
                                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                                <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                                <button type="submit" class="btn purchase-btn">
                                                    <i class="fa-solid fa-wand-sparkles"></i> Accio
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="btn scroll-btn right"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.slider-wrapper').forEach(wrapper => {
            const slider = wrapper.querySelector('.slider');
            const btnLeft = wrapper.querySelector('.scroll-btn.left');
            const btnRight = wrapper.querySelector('.scroll-btn.right');
            const scrollAmount = slider.clientWidth / 2;

            btnLeft.addEventListener('click', () => {
                slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });
            btnRight.addEventListener('click', () => {
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
        });

        // Search filter
        document.getElementById('item-search').addEventListener('input', e => {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.item-card').forEach(card => {
                card.style.display = card.dataset.name.includes(term) ? 'flex' : 'none';
            });
            document.querySelectorAll('.category-section').forEach(sec => {
                sec.style.display = Array.from(sec.querySelectorAll('.item-card'))
                    .some(c => c.style.display === 'flex') ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>