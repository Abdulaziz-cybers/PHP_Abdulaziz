<?php


class Workday{
    public static $WORK_TIME = 8;
    public $pdo;

    public function __construct() {
        $db = new Conn(); 
        $this->pdo = $db->pdo;
    }
    public function getTrackerData() {
        $query = "SELECT * FROM tracker";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function insertToTable(string $fish, string $arrived_at, string $leaved_at){
        $arrived_at = new DateTime($_POST['arrived_at']);
        $leaved_at = new DateTime($_POST['leaved_at']);

        $diff = $arrived_at->diff($leaved_at);
        $hour = $diff->h;
        $minute = $diff->i;
        $second = $diff->s;
        $total = ((self::$WORK_TIME * 3600) - (($hour* 3600) + ($minute * 60)));

        $query = "INSERT INTO tracker (arrived, leaved, fish, required_of) VALUES (:arrived_at, :leaved_at, :fish, :required_of)";

        $db = new Conn();
        $pdo = $db->pdo;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':arrived_at', $arrived_at->format('Y-m-d H:i'));
        $stmt->bindValue(':leaved_at', $leaved_at->format('Y-m-d H:i'));
        $stmt->bindParam(':fish', $fish);
        $stmt->bindParam('required_of',$total);
        $stmt->execute();
        header("Location: ./index.php");
    }

    public function markAsDone(int $id){
        $query = "Update tracker set required_of = 0 Where id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        header("Location: ./index.php");
    }
}