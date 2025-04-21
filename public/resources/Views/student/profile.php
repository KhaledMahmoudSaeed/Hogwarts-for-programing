<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];// get the id from JWT
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data[0]['uname'] ?>'s Profile</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <?php $bgcolor = strtolower($data[0]['role']) == 'professor' ? '#000' : "var(--" . strtolower($data[0]['hname']) . ")" ?>

    <style>
        #profile {
            background: url('<?= $GLOBALS['img']->image($data[0]['hname'], "users") . ".gif" ?>') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        #profile .overlay {
            flex: 1;
            width: 100%;
        }

        #profile .detail-card {
            background-color: rgba(31, 31, 31, 0.5);
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid
                <?= $bgcolor ?>
            ;
            position: relative;
            overflow: hidden;
            transition: transform 0.5s ease;
        }

        #profile .profile-wand {
            background-color: rgba(31, 31, 31, 0.5);
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid
                <?= $bgcolor ?>
            ;
            grid-column: 1 / -1;
            position: relative;
            transition: transform 0.5s ease;
        }

        #profile .detail-card::before,
        #profile .profile-wand::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 30px;
            height: 30px;
            background-color:
                <?= $bgcolor ?>
            ;
            clip-path: polygon(0 0, 100% 0, 100% 100%);
            border-top-right-radius: 5px;
        }
    </style>
</head>

<body>
    <?php
    require __DIR__ . "/../layout/navbar.view.php"
        ?>
    <section id="profile">
        <div class="overlay">
            <div class="profile-container">
                <div class="profile-header" style="background-color: <?= $bgcolor ?>;">
                    <div class="profile-image">
                        <img src="<?= $GLOBALS['img']->image($data[0]['img'], "users") ?>" alt="Profile Picture">
                    </div>
                    <form action="/profile/edit" method="POST" class="inline-block">
                        <input type="hidden" name="_method" value="GET">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="hidden" name="name" value="<?= $data[0]['uname']; ?>">
                        <input type="hidden" name="email" value="<?= $data[0]['email']; ?>">
                        <input type="hidden" name="img" value="<?= $data[0]['img']; ?>">
                        <button type="submit" class="btn text-green-500 hover:text-green-700" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </form>
                    <h1><?= $data[0]['uname'] ?></h1>
                    <p class="house-badge"><?= $data[0]['hname'] ?></p>
                </div>

                <div class="profile-details">

                    <div class="detail-card">
                        <h2><i class="fas fa-envelope"></i> Email</h2>
                        <p><?= $data[0]['email'] ?></p>
                    </div>
                    <div class="detail-card">
                        <h2><i class="fas fa-coins"></i> Money</h2>
                        <p>
                            <?= $data[0]['money'] ?>
                        </p>
                    </div>

                    <div class="profile-wand">
                        <h2><i class="fa-solid fa-wand-sparkles"></i> Wand</h2>
                        <div class="wand-details">
                            <div class="wand-property">
                                <span class="wand-label">Wood:</span>
                                <span class="wand-value"><?= $data[0]['wood'] ?></span>
                            </div>
                            <div class="wand-property">
                                <span class="wand-label">Core:</span>
                                <span class="wand-value"><?= $data[0]['core'] ?></span>
                            </div>
                        </div>
                    </div>


                    <!-- Purchase History Section -->
                    <div class="detail-card purchase-history">
                        <h2><i class="fas fa-shopping-cart"></i> Purchase History</h2>

                        <?php if (!empty($data[0]['purchases'])): ?>
                            <ul>
                                <?php foreach ($data[0]['purchases'] as $p): ?>
                                    <li>
                                        <img src="<?= $GLOBALS['img']->image($p['item_img'], 'items') ?>"
                                            alt="<?= htmlspecialchars($p['item_name']) ?>" class="purchase-thumb">
                                        <div class="purchase-info">
                                            <strong><?= htmlspecialchars($p['item_name']) ?></strong>
                                            <span class="type">(<?= htmlspecialchars($p['item_type']) ?>)</span><br>
                                            <span class="price"><?= htmlspecialchars($p['item_price']) ?> Galleons</span><br>
                                            <small class="date">
                                                Purchased on <?= date('F j, Y', strtotime($p['purchased_at'])) ?>
                                            </small>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>You haven’t acquired any magical items yet.</p>
                            <button onclick="window.location.href='/diagon-alley'"
                                class="inline-block bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded-md shadow-md hover:bg-yellow-400 transition-colors duration-300 cursor-pointer">
                                Go Buy Some
                            </button> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>