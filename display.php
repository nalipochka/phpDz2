<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="display.php" method="get">
            <div class="mb-3 w-25">
                <label for="m" class="form-label">Enter a number:</label>
                <input type="number" name="m" class="form-control" min=1 max=12 required>
            </div>
            <button type="submit" class="btn btn-outline-info">Submit</button>
        </form>

        <?
            function generateMonth($m){
                if($m < 1 || $m > 12){
                    echo "Invalid month value. Please enter a value between 1 and 12.";
                }

                $year = date("Y");
                $monatName = date("F", mktime(0,0,0,$m,1));
                $daysOfMonat = cal_days_in_month(CAL_GREGORIAN, $m, $year);

                $daysOfWeek = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sut", "Sun"];

                echo "<h2>$monatName $year</h2>";
                echo "<table class='table'>";
                echo "<thead><tr>";

                foreach($daysOfWeek as $day){
                    echo "<th>$day</th>";
                }
                
                echo "</tr></thead>";

                $firstDayOfWeek = date('N', strtotime("$year-$m-01"));

                echo "<tbody class='table-group-divider'><tr>";

                for($i = 1; $i < $firstDayOfWeek; $i++){
                    echo "<td></td>";
                }

                for($day = 1; $day <= $daysOfMonat; $day++){
                    if($firstDayOfWeek > 7){
                        echo "</tr>";
                        $firstDayOfWeek = 1;
                    }
                    echo "<td>$day</td>";
                    $firstDayOfWeek++;
                }

                while($firstDayOfWeek <= 7){
                    echo "<td></td>";
                    $firstDayOfWeek++;
                }

                echo "</tr></tbody>";

                echo "</table>";
            }

            if(isset($_GET["m"])){
                $m = $_GET["m"];
                generateMonth($m);
            }
        ?>
    </div>
   
</body>
</html>