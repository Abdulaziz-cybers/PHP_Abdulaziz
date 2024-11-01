<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="col-md-10 text-center">
                <h1>WORK TIME TRACKER</h1>
            </div>
    <div class="container"> 
        <form method="post" class="form"> 
            <div class="form-group"> 
                <label for="arrived_at">Arrived At:</label> 
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at">
            </div>

            <div class="form-group"> 
                <label for="leaved_at">Leaved At:</label>
                <input type="datetime-local" class="form-control" id="leaved_at" name="leaved_at">
            </div>

            <div class="form-group"> 
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name"> 
            </div>

            <button type="submit" class="btn btn-primary">Yuborish</button>
        </form>
    </form>
    <?php
        define('WORK_TIME', 8);
        $pdo = new PDO("mysql:host=localhost;dbname=Work_time", "root", "root");

        if (isset($_POST['arrived_at'])) {
            $arrived_at = $_POST['arrived_at'];
            $leaved_at = $_POST['leaved_at'];
            $fish = $_POST['name'];

            // Insert the data into the tracker table
            $query = "INSERT INTO tracker (arrived, leaved, fish) VALUES (:arrived_at, :leaved_at, :fish)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':arrived_at', $arrived_at);
            $stmt->bindParam(':leaved_at', $leaved_at);
            $stmt->bindParam(':fish', $fish);
            $stmt->execute();

            // Fetch data from the tracker table
            $query = "SELECT * FROM tracker"; 
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the table
            echo "<table class='table table-dark table-striped table-bordered'>";
            echo "<tr><th>ID</th><th>Arrived At</th><th>Leaved At</th><th>Name</th></tr>"; 
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["arrived"] . "</td>";
                echo "<td>" . $row["leaved"] . "</td>";
                echo "<td>" . $row["FISH"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</body>
</html>