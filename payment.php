<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Responsive Payment getway form design</title>
	<link rel="stylesheet" type="text/css" href="payment.css">
</head>

<body>
	<header>
	<form action="payment_process.php" method="post" id="paymentForm">
		<div class="container" >
			
				<div class="left">
					<h3>BILLING ADDRESS</h3>
					<form>
						Full name
						<input type="text" name="" placeholder="Enter name" required>
						Email
						<input type="text" name="" placeholder="Enter email" required>

						Address
						<input type="text" name="" placeholder="Enter address" required>

						City
						<input type="text" name="" placeholder="Enter City" required>
						<div id="zip">
							<label >
								State
								<select required>
									<option>Choose State..</option>
									<option>northern</option>
									<option>eastern</option>
									<option> southern</option>
									<option>western</option>
								</select>
							</label>
							<label>
								Zip code
								<input type="number" name="" placeholder="Zip code" required>
							</label>
						</div>
					</form>
				</div>
				<div class="right">
					<h3>PAYMENT</h3>
					<form required>
						Accepted Card <br>
						<img src="image/card1.png" width="100">
						<img src="image/card2.png" width="50">
						<br><br>

						Credit card number
						<input type="text" name="" placeholder="Enter card number">

						Exp month
						<input type="text" name="" placeholder="Enter Month">
						<div id="zip">
							<label>
								Exp year
								<select>
									<option>Choose Year..</option>
									<option>2022</option>
									<option>2023</option>
									<option>2024</option>
									<option>2025</option>
								</select>
							</label>
							<label>
								CVV
								<input type="number" name="" placeholder="CVV">
							</label>
						</div>
					</form>
					<input type="submit" name="" value="Proceed to Checkout" id="checkoutBtn">
				</div>
				
		</div>
		<form>
	</header>

	<script>
        // Get form and button elements
        const form = document.getElementById('paymentForm');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // Function to validate form fields
        function validateForm() {
            // Example validation: Check if the email field is empty
            const emailField = document.getElementById('email');
            if (emailField.value.trim() === '') {
                alert('Please fill in the email field.');
                return false; // Prevent form submission
            }

            // You can add more validation checks for other fields as needed

            return true; // Allow form submission if all fields are valid
        }

        // Event listener for the checkout button
        checkoutBtn.addEventListener('click', function(event) {
            // Validate the form when the button is clicked
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>
</body>

</html>