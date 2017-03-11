#<html>
#<body>

<?php

function calcDis($lat1,$lon1,$lat2,$lon2){
        $earth_radius = 3960.00; # in miles
        $distance  = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon2-$lon1)) ;
        $distance  = acos($distance);
        $distance  = rad2deg($distance);
        $distance  = $distance * 60 * 1.1515;
        $distance1  = round($distance, 4);

        // use a second method as well and average          
        $radius = 3959;  //approximate mean radius of the earth in miles, can change to any unit of measurement, will get results back in that unit
    $delta_Rad_Lat = deg2rad($lat2 - $lat1);  //Latitude delta in radians
    $delta_Rad_Lon = deg2rad($lon2 - $lon1);  //Longitude delta in radians
    $rad_Lat1 = deg2rad($lat1);  //Latitude 1 in radians
    $rad_Lat2 = deg2rad($lat2);  //Latitude 2 in radians

    $sq_Half_Chord = sin($delta_Rad_Lat / 2) * sin($delta_Rad_Lat / 2) + cos($rad_Lat1) * cos($rad_Lat2) * sin($delta_Rad_Lon / 2) * sin($delta_Rad_Lon / 2);  //Square of half the chord length
    $ang_Dist_Rad = 2 * asin(sqrt($sq_Half_Chord));  //Angular distance in radians
    $distance2 = $radius * $ang_Dist_Rad;  
        //echo "distance=$distance and distance2=$distance2\n";
    $avg_distance=-1;
    $distance1=acos(2);
        if((!is_nan($distance1)) && (!is_nan($distance2))){
            $avg_distance=($distance1+$distance2)/2;
        } else {
            if(!is_nan($distance1)){
                $avg_distance=$distance1;
                try{
                    //throw new Exception("distance1=NAN with lat1=$lat1 lat2=$lat2 lon1=$lon1 lon2=$lon2");
                } catch(Exception $e){
                    trigger_error($e->getMessage());
                    trigger_error($e->getTraceAsString());
                }
            }
            if(!is_nan($distance2)){
                $avg_distance=$distance2;
                try{
                    //throw new Exception("distance1=NAN with lat1=$lat1 lat2=$lat2 lon1=$lon1 lon2=$lon2");
                } catch(Exception $e){
                    trigger_error($e->getMessage());
                    trigger_error($e->getTraceAsString());
                }
            }
        }
return $avg_distance*1.6;

}

	
    $lat1 = $_POST["lat1"];
    $lon1 = $_POST["lon1"];
    $lat2 = $_POST["lat2"];
    $lon2 = $_POST["lon2"];

    $dist = calcDist($lat1,$lon1,$lat2,$lon2)
  
echo json_encode($dist);
?>

#</body>
#</html>