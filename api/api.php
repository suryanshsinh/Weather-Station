<?php 
    date_default_timezone_set("Asia/Kolkata");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $time = date("H:i:s");
        $date = date("d-m-Y");

        try {
            $logs = @fopen("Logs_".$date.".csv","r");
            if (!$logs) {
                throw new Exception('Failed to open file');
            }
            else {
                fclose($logs);
            }
        }
        catch (Exception $e) {
            $logs = fopen("Logs_".$date.".csv", "w");
            fwrite($logs, 'time,temperature,pressure,humidity'."\n");
            fclose($logs);
        }
        
        $temp = $_POST['temperature'];
        $humi = $_POST['humidity'];
        $pres = $_POST['pressure'];
        $values = array(
            "time" => "$time",
            "temperature" => "$temp",
            "humidity" => "$humi",
            "pressure" => "$pres",
        );

        $readings = fopen('Readings.json', 'w');
        $logs = fopen("Logs_".$date.".csv", 'a');
        fwrite($readings, json_encode($values)."\n");
        fclose($readings);
        fwrite($logs, $values['time'].','.$values['temperature'].','.$values['pressure'].','.$values['humidity']."\n");
        fclose($logs);
    }
    else {
        echo "Request in GET Mode";
    }