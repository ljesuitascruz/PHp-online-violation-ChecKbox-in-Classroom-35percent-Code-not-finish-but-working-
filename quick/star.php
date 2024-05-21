<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My 4-A Report</title>
    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #1E90FF); /* Gradient sky blue */
            font-family: Arial, sans-serif;
            color: #ffffff; /* Change text color to white for better contrast */
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 50px; /* Adjust margin-top as needed */
        }
        form {
            text-align: center;
            margin-top: 20px; /* Adjust margin-top as needed */
        }
        form input[type="checkbox"] {
            margin: 5px;
        }
        .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start; /* Align items to the top */
            flex-wrap: wrap;
        }
        .table-container {
            display: inline-block;
            margin: 10px;
        }
        table {
            border-collapse: collapse;
            width: 200px;
            border: 1px solid #ffffff;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ffffff;
        }
        .no-report {
            color: red; /* Change text color to red */
        }
        /* Style for the custom button */
        .custom-button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }
        /* Style for the custom button on hover */
        .custom-button:hover {
            background-color: #45a049;
        }
        /* Background color for the table containing names */
        .name-table {
            background-color: #333; /* Dark gray */
        }
    </style>
</head>
<body>
    <h1>UNIFORM POLICY REPORT </h1>

    <div class="container">
        <div class="table-container">
            <form action="star.php" method="POST">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">
                <br>
                <?php
                    $names = ['Joshua Anacta', 'Jasmine Rivera', 'Ginalyn Rivera', 'Justin Pimentel', 'Ralph Aquino ', 'Mikee Secretarya', 'Mark Joshua Celi'];
                    foreach ($names as $index => $name) {
                        echo "$name: <br>";
                        echo "No Uniform: <input type='checkbox' name='choices[]' value='No Uniform$index'>";
                        echo "No Black Shoes: <input type='checkbox' name='choices[]' value='No Black Shoes$index'>";
                        echo "Slippers: <input type='checkbox' name='choices[]' value='Slippers$index'>";
                        echo "<br>";
                    }
                ?>
                <br>
                <!-- Modified submit button -->
                <button type="submit" class="custom-button">Submit</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $choices = $_POST["choices"];
            $date = $_POST["date"];

            echo '<div class="table-container">';
            echo "<table>";
            echo "<tr><th>Date</th><td>$date</td></tr>";
            echo "<tr><th>Selected Violation</th></tr><tr><td>";
            if (!empty($choices)) {
                foreach ($choices as $choice) {
                    echo $choice . "<br>";
                }
            } else {
                echo "<span class='no-report'>No choices Violation.</span>";
            }
            echo "</td></tr></table></div>";

            // Display selections for each name
            echo '<div class="table-container">';
            echo "<table class='name-table'>"; // Add class name-table here
            echo "<tr><th>Name</th><th>Selected Violation</th></tr>";

            foreach ($names as $index => $name) {
                $nameSelections = array_filter($choices, function($choice) use ($index) {
                    return in_array($choice, ["No Uniform$index", "No Black Shoes$index", "Slippers$index"]);
                });

                echo "<tr>";
                echo "<td>$name</td>";
                echo "<td>";
                if (!empty($nameSelections)) {
                    foreach ($nameSelections as $selection) {
                        echo $selection . "<br>";
                    }
                } else {
                    echo "<span class='no-report'>No Report selected.</span>";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</table></div>";
        }
        ?>
    </div>

</body>
</html>
