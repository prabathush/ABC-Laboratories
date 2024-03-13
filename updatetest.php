<!-- updatepage.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test Detail</title>
    <!-- Add your CSS stylesheets or include them externally -->
</head>
<body>
    <h2>Edit Test Detail</h2>
    <?php
    // Check if test detail data is available
    if (!empty($detail)) {
        ?>
        
        <form class="update-form" method="post" action="edit_test_detail.php">
            <input type="hidden" name="id" value="<?php echo $detail['id']; ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="test_name">Test Name:</label>
                    <input type="text" id="test_name" name="test_name" value="<?php echo $detail['test_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="test_type">Test Type:</label>
                    <input type="text" id="test_type" name="test_type" value="<?php echo $detail['test_type']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $detail['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="preparation_instructions">Preparation Instructions:</label>
                    <textarea id="preparation_instructions" name="preparation_instructions" required><?php echo $detail['preparation_instructions']; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="sample_type">Sample Type:</label>
                    <input type="text" id="sample_type" name="sample_type" value="<?php echo $detail['sample_type']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="normal_range">Normal Range:</label>
                    <input type="text" id="normal_range" name="normal_range" value="<?php echo $detail['normal_range']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $detail['price']; ?>" required>
                </div>
                <!-- Add other input fields for test details -->
            </div>
            <button type="submit" name="submit" class="submit-btn">Update</button>
        </form>
        <?php
    } else {
        echo "<p>No test detail found.</p>";
    }
    ?>
</body>
</html>
