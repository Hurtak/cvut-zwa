<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>6. cvičení</title>
    </head>
    <body>
        <h1>6. cvičení</h1>

        <?php
            // phpinfo();
        ?>

        <p>
            Ukoly z
            <a href="https://cw.fel.cvut.cz/wiki/courses/b6b39zwa/tutorials/06/start">https://cw.fel.cvut.cz/wiki/courses/b6b39zwa/tutorials/06/start</a>
        </p>

        <h2>1) Výpis aktuálního data</h2>
        <?php
            echo date("d. m. Y");
        ?>

        <h2>2) Práce s datem</h2>
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

        <h2>3) Funkce &amp; 4) Průchod pole</h2>
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

        <h2>5) Vytváření pole</h2>
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

        <h2>6) Unikátní měsíce</h2>
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
