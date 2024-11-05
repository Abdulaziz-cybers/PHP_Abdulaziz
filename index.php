<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha383-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color:#ffebcd ">
    <div class="col-md-10 text-center">
                <h1>WORK TIME TRACKER</h1>
    </div>
    
    <div class="container"> 
        <form method="post" class="form d-flex justify-content-center" class="form border-radius:15px" style="background-color:coral" >
            <div class="row" >
                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="arrived_at" style="color:aqua">Arrived At:</label> 
                        <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at" required>
                    </div>
                </div>

                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="leaved_at" style="color:aqua">Leaved At:</label>
                        <input type="datetime-local" class="form-control" id="leaved_at" name="leaved_at" required>
                    </div>
                </div>

                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="name" style="color:aqua">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required> 
                    </div>
                </div>
            
                <div class="col-md-3" >
                    <button type="submit" class="btn btn-primary">Yuborish</button>
                </div>
            </div>
        </form>
    </form>
    <?php
        define('WORK_TIME', 8);
        $pdo = new PDO("mysql:host=localhost;dbname=Work_time", "root", "root");

        if (isset($_POST['arrived_at'])) {
            $arrived_at = new DateTime($_POST['arrived_at']);
            $leaved_at = new DateTime($_POST['leaved_at']);
            $fish = $_POST['name'];

            $diff = $arrived_at->diff($leaved_at);
            $hour = $diff->h;
            $minute = $diff->i;
            $second = $diff->s;
            $total = ((WORK_TIME * 3600) - (($hour* 3600) + ($minute * 60)));

            // Insert the data into the tracker table
            $query = "INSERT INTO tracker (arrived, leaved, fish, required_of) VALUES (:arrived_at, :leaved_at, :fish, :required_of)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':arrived_at', $arrived_at->format('Y-m-d H:i'));
            $stmt->bindValue(':leaved_at', $leaved_at->format('Y-m-d H:i'));
            $stmt->bindParam(':fish', $fish);
            $stmt->bindParam('required_of',$total);
            $stmt->execute();
            header("Location: ./index.php"); // Bu qator qaytatdan faylga olib keladi, shuning uchun yozilgan ma'lumot refresh berilganda qaytib yozilmaydi 
        }

            // Fetch data from the tracker table
        $query = "SELECT * FROM tracker"; 
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the table
        echo "<table class='table table-primary table-striped table-bordered'>";
        echo "<tr><th>#</th><th>Name</th><th>Arrived At</th><th>Leaved at</th><th>Required</th></tr>"; 
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td style=color:red>" . $row["id"] . "</td>";
            echo "<td style=color:#8b008b>" . $row["FISH"] . "</td>";
            echo "<td style=color:brown>" . $row["arrived"] . "</td>";
            echo "<td style=color:green>" . $row["leaved"] . "</td>";
            echo "<td>" . gmdate('H:i',$row["required_of"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>