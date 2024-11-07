<!DOCTYPE html>
<html lang="en">
 
    <?php
        require 'view.php';
        $form = new Form();
        
        require 'Conn.php';
        require 'Workday.php';
        require 'Display_table.php';

        $db = new Conn();
        $pdo = $db->pdo;

        $tm = new Workday();

        echo '<div class=col-md-10 text-center style=color:#ffebcd> <h1>.</h1> </div>';
        if (isset($_POST['arrived_at'])) {
            $tm->insertToTable($_POST['name'], $_POST['arrived_at'], $_POST['leaved_at']);
        }

        if (isset($_GET['done']) && !empty($_GET['done'])){
            $tm->markAsDone($_GET['done']);
        }

        $rows = $tm->getTrackerData();
        $show = new displayTable($rows);
    ?>
</body>
</html>