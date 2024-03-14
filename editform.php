<!-- editform.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Test Details</h2>
        <?php
        require_once 'db_connection.php';

        // Fetch existing test details based on provided ID
        $id = $_GET['id'];
        $sql = "SELECT * FROM test_details WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $detail = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <form action="editprocess.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="test_name">Test Name:</label>
            <input type="text" id="test_name" name="test_name" value="<?= $detail['test_name'] ?>">

            <label for="test_type">Test Type:</label>
            <input type="text" id="test_type" name="test_type" value="<?= $detail['test_type'] ?>">

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?= $detail['description'] ?>">

            <label for="normal_range">Normal Range:</label>
            <input type="text" id="normal_range" name="normal_range" value="<?= $detail['normal_range'] ?>">

            <label for="sample_type">Sample Type:</label>
            <input type="text" id="sample_type" name="sample_type" value="<?= $detail['sample_type'] ?>">

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?= $detail['price'] ?>">

            <label for="preparation_instructions">Preparation Instructions:</label>
            <input type="text" id="preparation_instructions" name="preparation_instructions" value="<?= $detail['preparation_instructions'] ?>">

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
