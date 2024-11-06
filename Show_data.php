<?php

require_once'Conn.php';

function getTrackerData(){
    $db = new DB();
    $pdo = $db->pdo;

    $query = "SELECT * FROM tracker";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

function displayTable($rows){
    echo "<table class='table table-primary table-striped table-bordered'>";
    echo "<tr><th>#</th><th>Name</th><th>Arrived At</th><th>Leaved at</th><th>Required</th></tr>"; 
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td style='color:red'>" . $row["id"] . "</td>";
        echo "<td style='color:#8b008b'>" . $row["FISH"] . "</td>";
        echo "<td style='color:brown'>" . $row["arrived"] . "</td>";
        echo "<td style='color:green'>" . $row["leaved"] . "</td>";
        echo "<td>" . gmdate('H:i',$row["required_of"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}