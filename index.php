<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Tracker</title>
</head>
<body>
    <form method="post">
        <input type="datetime-local" name="arrived_at"><br>
        <input type="datetime-local" name="leaved_at"><br>
        <button type="submit">Yuborish</button>
    </form>

    <?php
        define('WORK_TIME', 8);
        $pdo = new PDO("mysql:host=localhost;dbname=Work_time", "root", "root");

        if (isset($_POST['arrived_at'])) {
            $arrived_at = $_POST['arrived_at'];
            $leaved_at = $_POST['leaved_at'];

            // Insert the data into the tracker table
            $query = "INSERT INTO tracker (arrived, leaved) VALUES (:arrived_at, :leaved_at)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':arrived_at', $arrived_at);
            $stmt->bindParam(':leaved_at', $leaved_at);
            $stmt->execute();

            // Display the submitted information
            echo "
            <h1>Arrived at: " . $arrived_at . "</h1>
            <h1>Leaved  at: " . $leaved_at . "</h1>
            <h1>Full worktime: " . WORK_TIME . "</h1>
            ";

            // Fetch data from the tracker table
            $query = "SELECT * FROM tracker"; 
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the table
            echo "<h1>The table containing all information</h1>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Arrived At</th><th>Leaved At</th></tr>";
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["arrived"] . "</td>";
                echo "<td>" . $row["leaved"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</body>
</html>