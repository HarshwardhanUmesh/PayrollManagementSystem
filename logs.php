<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* CSS styles for the log container */
        .log-container {
            width: 500px;
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 10px;
            border: 2px solid white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 80%;
        }

        /* CSS styles for log messages */
        .log-message {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="log-container container mt-5">
        <!-- Log messages -->
        <div class="log-message">
            <?php
            // Specify the path to your text file
            $filename = "logs.txt";

            // Open the file for reading
            $file = fopen($filename, "r");

            // Check if the file was opened successfully
            if ($file) {
                // Loop through the file line by line
                while (($line = fgets($file)) !== false) {
                    // Process each line as needed
                    echo $line;
                    echo "<br>";
                }

                // Close the file
                fclose($file);
            } else {
                echo "Unable to open the file.";
            }
            ?>

        </div>

    </div>

</body>

</html>