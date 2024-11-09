<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Of Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-image: url(https://cdn.culture.ru/images/74c21e43-8ea5-5846-9c11-98d40eb616fe)">
<div class="container">
    <h1 class="text-primary text-center mt-4">Work Of Tracker</h1>
    <div class="row align-items-end my-3">
        <div class="col">
            <form method="post" class="row g-3 mt-3 align-items-end class=form mt-4 p-3 rounded class=form d-flex justify-content-center" style="background-color:coral">
                <div class="col-auto">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="col-auto">
                    <label for="arrived_at">Arrived At</label>
                    <input type="datetime-local" name="arrived_at" class="form-control" id="arrived_at">
                </div>
                <div class="col-auto">
                    <label for="leaved_at">Leaved At</label>
                    <input type="datetime-local" name="leaved_at" class="form-control" id="leaved_at">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                <div class="col-auto">
                    <button form="export" type="submit" class="btn btn-success">Export</button>
                </div>
            </form>
            <!-- <form action="" id="export" method="post"> -->
            <form action="download.php" id="export" method="post">
                <input type="text" name="export" value="true" hidden="">
            </form>
        </div>
    </div>
    <table class="table table-primary table-hover  table-striped table-bordered">
        <thead>
        <tr class="table-secondary">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Arrived At</th>
            <th scope="col">Leaved At</th>
            <th scope="col">Required(h)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        global $records;
        $i = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $previousPage = $i > 1 ? $i - 1 : 1;
        $j = 1;
        foreach ($records as $record) {
            
            echo "<tr>
                <td>{$j}</td>
                <td>{$record['FISH']}</td>
                <td>{$record['arrived']}</td>
                <td>{$record['leaved']}</td>
                <td>" . gmdate('H:i',$record['required_of']) . "</td>
                <td><a href='index.php?done=" . $record['id'] . "'>Done</a></td>
            </tr>";
            $j ++;
        }

        ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            global $workDay, $currentPage;
            $disabled = $currentPage == 1 ? "disabled" : "";
            if ($currentPage > 1) {
                echo "<li class='page-item'><a class='page-link' href='index.php?page=$previousPage'>Previous</a></li>";
            }
            $pageCount = $workDay->calculatePageCount();

            for ($page = 1; $page <= $pageCount; $page++) {
                $active = $page == $currentPage ? "active" : "";
                echo "<li class='page-item $active''><a class='page-link'' href='index.php?page=" . $page . "''>" . $page . "</a></li>";
            }
            
            if ($currentPage < $pageCount) {
                echo "<li class='page-item'><a class='page-link' href='index.php?page=" . ($currentPage + 1) . "'>Next</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>
