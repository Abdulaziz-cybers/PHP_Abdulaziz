<!DOCTYPE html>
<html lang="en">
 
    <?php
        require 'view.php';
        $form = new Form();
        
        define('WORK_TIME', 8);
        require 'Conn.php';
        $db = new Conn();
        $pdo = $db->pdo;

        require 'TrackerManager.php';

        require 'Display_table.php';

        $tm = new TrackerManager();

        echo '<div class=col-md-10 text-center style=color:#ffebcd>
                    <h1>.</h1>
                </div>';

        if (isset($_POST['arrived_at'])) {
            $tm->insertToTable($_POST['name'], $_POST['arrived_at'], $_POST['leaved_at']);
            header("Location: ./index.php"); // Bu qator qaytatdan faylga olib keladi, shuning uchun yozilgan ma'lumot refresh berilganda qaytib yozilmaydi 
        }


        $rows = $tm->getTrackerData();
        $show = new displayTable($rows);
    ?>
</body>
</html>