<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ollivander's Magical Emporium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --gryffindor: #740001;
            --slytherin: #1a472a;
            --ravenclaw: #0e1a40;
            --hufflepuff: #ecb939;
            --hogwarts: #5d5d5d;
            --parchment: #f5e8c0;
            --ink: #3a3129;
            --gold: #ffd700;
        }

        body {
            font-family: 'Cinzel', serif;
            background-color: #0a0a0a;
            background-image: url('<?= $GLOBALS['img']->image("hogwarts_bg.jpg") ?>');
            background-size: cover;
            background-attachment: fixed;
            color: var(--ink);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .header h1 {
            color: var(--gold);
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }

        .header h2 {
            color: white;
            font-size: 1.5rem;
            font-style: italic;
        }

        .header::after {
            content: "";
            display: block;
            width: 200px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 20px auto;
        }

        .gold-counter {
            background-color: rgba(0, 0, 0, 0.7);
            border: 2px solid var(--gold);
            border-radius: 30px;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gold);
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            background-color: rgba(245, 232, 192, 0.9);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.3);
            border-collapse: separate;
            border-spacing: 0;
        }

        .items-table thead {
            background: linear-gradient(to right, var(--<?= strtolower($house) ?>), #000);
            color: white;
        }

        .items-table th {
            padding: 15px;
            text-align: left;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .items-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(58, 49, 41, 0.2);
            vertical-align: middle;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .items-table tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .item-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid var(--ink);
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .item-image:hover {
            transform: scale(1.1);
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--<?= strtolower($house) ?>);
            margin-bottom: 5px;
        }

        .item-type {
            font-style: italic;
            color: #666;
            font-size: 0.9rem;
        }

        .item-price {
            color: var(--gold);
            font-weight: bold;
            font-size: 1.1rem;
            white-space: nowrap;
        }

        .purchase-btn {
            background: linear-gradient(to bottom, var(--<?= strtolower($house) ?>), #000);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .purchase-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background: linear-gradient(to bottom, var(--gold), #daa520);
            color: var(--ink);
        }

        .message {
            background-color: rgba(28, 200, 138, 0.2);
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid #1cc88a;
        }

        @media (max-width: 768px) {
            .item-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .items-table td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-hat-wizard"></i> Ollivander's Emporium</h1>
            <h2>Magical Items & Artifacts</h2>

            <?php if (isset($_SESSION['money'])): ?>
                <div class="gold-counter">
                    <i class="fas fa-coins"></i>
                    <span>Your Gringotts Balance: <?php echo htmlspecialchars($_SESSION['money']); ?> Galleons</span>
                </div>
                <?php unset($_SESSION['money']); ?>
            <?php endif; ?>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Magical Item</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item): ?>
                    <tr>
                        <td>
                            <div class="item-card">
                                <img src="<?= $GLOBALS['img']->image($item['img'], "items") ?>"
                                    alt="<?= htmlspecialchars($item['name']) ?>" class="item-image">
                                <div class="item-info">
                                    <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div class="item-type"><?php echo htmlspecialchars($item['type']); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="item-price">
                            <?php echo htmlspecialchars($item['price']); ?> <i class="fas fa-coins"></i>
                        </td>
                        <td>
                            <form action="/items" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                                <button type="submit" class="purchase-btn">
                                    <i class="fas fa-magic"></i> Acquire
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>