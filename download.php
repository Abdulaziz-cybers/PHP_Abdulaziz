<?php

if (isset($_POST['export'])){
    require 'Workday.php';
    $workday = new Workday();
    $records = $workday->getWorkDayList();
    $output = fopen('php://output','w');
    $columns = ['#','Ism','Kelgan','Ketgan','Qarzdorlik'];

    fputcsv($output,$columns);
    $i = 0;

    foreach ($records as $record){
        $i++;
        $record['required_of'] = gmdate('H:i', $record['required_of']);
        $record['id'] = $i;
        fputcsv($output,$record);
    }

    $filename = 'Tracker.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '""');
    header('Pragma: no-cache');
    header('Expires: 0');
}