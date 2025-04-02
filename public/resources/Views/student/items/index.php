<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magical Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005f73;
        }

        .message {
            color: green;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Magical Items List</h2>

    <?php if (isset($_SESSION['money'])): ?>
        <p class="message">Your current balance: <?php echo htmlspecialchars($_SESSION['money']); ?> Gold</p>
        <?php unset($_SESSION['money']);
    endif; ?>

    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['price']); ?> Gold</td>
                <td><?php echo htmlspecialchars($item['type']); ?></td>
                <td>
                    <form action="/items" method="POST">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                        <button type="submit">Purchase</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>