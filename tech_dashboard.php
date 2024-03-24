<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(#6899c2, #afd7f7);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            background-color: #003d7f;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            position: absolute;
            top: 0;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .button-container button {
            padding: 20px 50px; /* Adjusted padding to make buttons larger */
            font-size: 20px;
            background-color: #003d7f;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px;
            width: 350px; /* Added width to ensure all buttons have the same size */
            height: 200px; /* Added height to ensure all buttons have the same size */
            position: relative;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .button-container button i {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 50px;
        }
    </style>
</head>
<body>
<header>
    <h1>Technician Dashboard</h1>
</header>
<main>
    <div class="button-container">
        <button onclick="location.href='tech_profile.php';">
            Profile
            <i class="fas fa-user"></i> <!-- Example icon from Font Awesome -->
        </button>
        <button onclick="location.href='tech_test_results.php';">
            Test Results
            <i class="fas fa-file-medical"></i> <!-- Example icon from Font Awesome -->
        </button>
    </div>
    <div class="button-container">
        <button onclick="location.href='view_uploaded_prescriptions.php';">
            View Uploaded Prescriptions
            <i class="fas fa-file-prescription"></i> <!-- Example icon from Font Awesome -->
        </button>
        <button onclick="location.href='view_quotations.php';">
            View Quotations
            <i class="fas fa-file-invoice-dollar"></i> <!-- Example icon from Font Awesome -->
        </button>
    </div>
</main>
</body>
</html>
