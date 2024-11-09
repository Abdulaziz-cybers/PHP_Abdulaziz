<?php

require 'Conn.php';

class WorkDay{
    const REQUIRED_HOUR_DURATION = 8;
    public $conn;
    public function __construct () {
        $db = new Conn();
        $this->conn = $db->pdo;
    }
    public function store (string $name, string $arrived_at, string $leaved_at) {
        // parametrdan arrived_at ni olib date object yasaymiz
        $arrived_at = new DateTime($arrived_at);
        $leaved_at = new DateTime($leaved_at);
        $diff = $arrived_at->diff($leaved_at);
        $hour = $diff->h;
        $minute = $diff->i;
        $total = ((self::REQUIRED_HOUR_DURATION * 3600) - (($hour * 3600) + ($minute * 60)));
        $query = "INSERT INTO tracker (FISH,arrived,leaved, required_of) 
                        VALUES (:FISH, :arrived_at, :leaved_at, :required_of)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':FISH', $name);
        $stmt->bindValue(':arrived_at', $arrived_at->format('Y-m-d H:i'));
        $stmt->bindValue(':leaved_at', $leaved_at->format('Y-m-d H:i'));
        $stmt->bindParam(':required_of', $total);
        $stmt->execute();
        header('Location: index.php');
        return;
    }
    public function getWorkDayList () {
        $query = "SELECT * FROM tracker ORDER BY arrived DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function markAsDone (int $id) {
        $query = "UPDATE tracker SET required_of = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: index.php');
    }
    public function calculateDebtTimeForEachUser () {
        $query = "SELECT FISH, SUM(required_of) as debt FROM tracker GROUP BY FISH";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll();
    }
    public function getWorkDayListWithPagination (int $offset) {
        $offset = $offset ? ($offset * 10)-10 : 0;
        $query = "SELECT * FROM tracker ORDER BY arrived DESC LIMIT 10 OFFSET " . $offset;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalRecords () {
        $query = "SELECT COUNT(id) as pageCount FROM tracker";
        $stmt = $this->conn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function calculatePageCount () {
        $total = $this->getTotalRecords()['pageCount'];
        return ceil($total/10);
    }
}