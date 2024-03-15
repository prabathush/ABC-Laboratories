<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacist Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(#6899c2 ,  #afd7f7 );      }

        header {
            background-color: darkblue;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        main {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100vh;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            color:  #042ca9 ;
        }

        button {
            padding: 150px 200px;
            font-size: 20px;
            background-color: #003d7f;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>Pharmacist Dashboard</h1>
</header>
<main>
    <div class="button-container">
        <button onclick="location.href='view_uploaded_prescriptions.php';">View Uploaded Prescriptions</button>
    </div>
    <div class="button-container">
        <button onclick="location.href='view_quotations.php';">View Quotations</button>
    </div>
</main>
</body>
</html>
