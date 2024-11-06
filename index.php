<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha383-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php

?>
<body style="background-color:#ffebcd ">
    <div class="col-md-10 text-center">
                <h1>WORK TIME TRACKER</h1>
    </div>
    
    <div class="container"> 
    <?php
        require 'Form.php';
        $form = new Form();
        $form->render();
        
        define('WORK_TIME', 8);
        require 'Conn.php';
        $db = new DB();
        $pdo = $db->pdo;

        if (isset($_POST['arrived_at'])) {
            $arrived_at = new DateTime($_POST['arrived_at']);
            $leaved_at = new DateTime($_POST['leaved_at']);
            $fish = $_POST['name'];

            $diff = $arrived_at->diff($leaved_at);
            $hour = $diff->h;
            $minute = $diff->i;
            $second = $diff->s;
            $total = ((WORK_TIME * 3600) - (($hour* 3600) + ($minute * 60)));

            $query = "INSERT INTO tracker (arrived, leaved, fish, required_of) VALUES (:arrived_at, :leaved_at, :fish, :required_of)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':arrived_at', $arrived_at->format('Y-m-d H:i'));
            $stmt->bindValue(':leaved_at', $leaved_at->format('Y-m-d H:i'));
            $stmt->bindParam(':fish', $fish);
            $stmt->bindParam('required_of',$total);
            $stmt->execute();
            header("Location: ./index.php"); // Bu qator qaytatdan faylga olib keladi, shuning uchun yozilgan ma'lumot refresh berilganda qaytib yozilmaydi 
        }

        require 'Show_data.php';

        $rows = getTrackerData();

        displayTable($rows)
    ?>
</body>
</html>