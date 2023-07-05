<?php

$file = file_get_contents('https://gist.githubusercontent.com/miisieq/379bb51bb376b2fd597d19281a7bbff6/raw/573dd374139cc72ffb555fef80af8263d2d26cd2/php_internship_data.csv');
$data = explode("\n", $file);
$namesCount = [];
$dateCount = [];

foreach ($data as $row) {
    if (empty($row)) {
        continue;
    }

    $rowData = explode(',', $row);
    if (array_key_exists($rowData[0], $namesCount)) {
        $namesCount[$rowData[0]]++;
    } else {
        $namesCount[$rowData[0]] = 1;
    }

    $dateArray = explode('-', $rowData[1]); 
    if (intval($dateArray[0]) >= 2000) { 
        $parsedDate = $dateArray[2] . '.' . $dateArray[1] . '.' . $dateArray[0];
        if (array_key_exists($parsedDate, $dateCount)) {
            $dateCount[$parsedDate]++;
        } else {
            $dateCount[$parsedDate] = 1;
        }
    }
}

arsort($namesCount);
arsort($dateCount);

foreach (array_slice($namesCount, 0, 10) as $name => $count) {
    echo ucfirst(mb_strtolower($name)) . ' - ' . $count . ' razy' . '<br>';
}
echo '<br> ZADANIE DODATKOWE <br>';
foreach (array_slice($dateCount, 0, 10) as $date => $count) {
    echo $date . ' - ' . $count . ' razy' . '<br>';
}

