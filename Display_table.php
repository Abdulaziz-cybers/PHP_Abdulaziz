<?php

class displayTable{
    public function __construct($rows){
        echo "<table class='table table-primary table-striped table-bordered'>";
        echo "<tr><th>#</th><th>Name</th><th>Arrived At</th><th>Leaved at</th><th>Required(h)</th></tr>"; 
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
}