<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prepare Quotation</title>
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="quotation_style.css">
</head>
<body>
    
    <div class="container">
        
        <div class="left">
            <h2>Uploaded Prescription Images</h2>
            <!-- Display uploaded prescription images here -->
            <div class="prescription-images">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc laboratories";
    
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Fetch prescription images uploaded by the user
    $user_id = $_GET['user_id']; // Get user ID from the URL parameter
    $sql = "SELECT * FROM prescriptions WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display prescription images
    while ($row = $result->fetch_assoc()) {
        for ($i = 1; $i <= 5; $i++) {
            $image_url = $row["image_" . $i];
            if (!empty($image_url)) {
                echo "<img src='" . $image_url . "' alt='Prescription Image'>";
            }
        }
    }
    ?>
</div>

        </div>
        <div class="right">
        <h2>Quotation Preparation</h2>
            <div class="quotation-details">
                <div class="added-drugs">
                    <!-- Placeholder for added drugs -->
                </div>
                <div class="total">
                    <span>Total:</span>
                    <span id="total-price">Rs 0.00 </span>
                </div>
            </div>
           
            <!-- Form for drug quantity and amount -->
            <form action="quotation_handler.php" method="post" id="quotation-form">
                <label for="drug">Drug:</label>
                <input type="text" id="drug" name="drug" required>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                <button type="button" id="add-drug">Add</button>
            </form><br>
            <button type="submit" form="quotation-form" name="send_quotation">Send Quotation</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('quotation-form');
            const addBtn = document.getElementById('add-drug');
            const totalPrice = document.getElementById('total-price');
            const drugsList = document.querySelector('.added-drugs');

            let total = 0;

            addBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const drug = document.getElementById('drug').value;
                const quantity = parseInt(document.getElementById('quantity').value);
                const price = parseFloat(document.getElementById('price').value);

                const amount = quantity * price;
                total += amount;

                const drugItem = document.createElement('div');
                drugItem.classList.add('drug-item');
                drugItem.innerHTML = `
                    <span>${drug}</span>
                    <span>${quantity} x ${price.toFixed(2)}</span>
                    <span>${amount.toFixed(2)}</span>
                `;

                // Insert the new drug item at the beginning of the drugs list
                drugsList.insertBefore(drugItem, drugsList.firstChild);
                totalPrice.textContent = total.toFixed(2);

                // Reset form fields
                form.reset();
            });
        });
    </script>
</body>
</html>
