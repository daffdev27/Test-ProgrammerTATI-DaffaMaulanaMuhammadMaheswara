<?php
function helloworld($n) {
    $result = [];
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 4 == 0 && $i % 5 == 0) {
            $result[] = "helloworld";
        } elseif ($i % 4 == 0) {
            $result[] = "hello";
        } elseif ($i % 5 == 0) {
            $result[] = "world";
        } else {
            $result[] = $i;
        }
    }
    return implode(" ", $result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #ffe5e5;
            color: #8b0000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffcccc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            display: inline-block;
            max-width: 400px;
            width: 90%;
        }
        input, button {
            font-size: 16px;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #8b0000;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #8b0000;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #b22222;
        }
        #output {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #8b0000;
            padding: 10px;
            border-radius: 5px;
            background: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello World Generator</h1>
        <form method="POST">
            <input type="number" name="number" placeholder="Enter a number" required>
            <button type="submit">Generate</button>
        </form>
        <div id="output">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["number"])) {
                $n = intval($_POST["number"]);
                echo helloworld($n);
            }
            ?>
        </div>
    </div>
</body>
</html>