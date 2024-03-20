<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: darkblue;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ABC Laboratories</h1>
        <div class="message">
            <p>Thank you for choosing ABC Laboratories. Your quotation has been sent to the user.</p>
        </div>
        <table>
            <tr>
                <th>Drug</th>
                <td><?= isset($quotation['drug']) ? $quotation['drug'] : '' ?></td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td><?= isset($quotation['quantity']) ? $quotation['quantity'] : '' ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?= isset($quotation['price']) ? $quotation['price'] : '' ?></td>
            </tr>
        </table>
        <p>For any inquiries or assistance, please contact us at:</p>
        <p>ABC Laboratories<br>
        123 Main Street, City<br>
        State, Country<br>
        Phone: +123-456-7890<br>
        Email: info@abclab.com</p>
        <div class="copyright">
            <p>&copy; <?= date('Y') ?> ABC Laboratories. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
