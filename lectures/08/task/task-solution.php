<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Task solution</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>PHP</h1>

        <p>
            Do tasks from
            <a href="https://cw.fel.cvut.cz/wiki/courses/b6b39zwa/tutorials/08/start">https://cw.fel.cvut.cz/wiki/courses/b6b39zwa/tutorials/08/start</a>
        </p>

        <?php
            // phpinfo();
        ?>

        <h2>1) Print current date</h2>
        <?php
            echo date("d. m. Y");
        ?>

        <h2>2) Work with dates</h2>
        <?php
            $datum = "30.11.2016";
            $timestamp = strtotime($datum);
            $day = date("N", $timestamp);
            $daysDictionary = [
                1 => "Pondělí",
                2 => "Úterý",
                3 => "Strěda",
                4 => "Čtvrtek",
                5 => "Pátek",
                6 => "Sobota",
                7 => "Neděle"
            ];
            echo $daysDictionary[$day];
        ?>

        <h2>3) Functions &amp; 4) Array iteration</h2>
        <?php
            function dateToDay($date) {
                $timestamp = strtotime($date);

                $day = date('N', $timestamp);
                $daysDictionary = [
                    1 => "Pondělí",
                    2 => "Úterý",
                    3 => "Strěda",
                    4 => "Čtvrtek",
                    5 => "Pátek",
                    6 => "Sobota",
                    7 => "Neděle"
                ];

                return $daysDictionary[$day];
            }

            $dates = ['30.11.2016', '1.12.2016', '2.12.2016'];
            foreach ($dates as $key => $value) {
                echo $key + 1 . ") " . $value . " ­ " . dateToDay($value) . "<br>";
            }
        ?>

        <h2>5) Arrays manipulation</h2>
        <?php
            function datesToMonthNumbers($dates) {
                $monthNumbers = [];
                foreach ($dates as $key => $date) {
                    $timestamp = strtotime($date);
                    $monthNumber = date("n", $timestamp);
                    $monthNumbers[] = $monthNumber;
                }
                return $monthNumbers;
            }

            $monthNumbers = datesToMonthNumbers($dates);
            print_r($monthNumbers);
        ?>

        <h2>6) Unique months</h2>
        <?php
            function getUniqueMonthNumbers($dates) {
                $monthNumbers = [];
                foreach ($dates as $key => $date) {
                    $timestamp = strtotime($date);
                    $monthNumber = date("n", $timestamp);
                    $alreadyExists = in_array($monthNumber , $monthNumbers);
                    if (!$alreadyExists) {
                        $monthNumbers[] = $monthNumber;
                    }
                }
                return $monthNumbers;
            }

            $dates = ['30.11.2016', '1.12.2016', '2.12.2016'];
            $monthNumbers = getUniqueMonthNumbers($dates);
            print_r($monthNumbers);
        ?>

    </body>
</html>
