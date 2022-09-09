
  
     <?php
     echo distance(2.346279, -76.669494, 2.442025, -76.598040);
      function distance($lat1, $lon1, $lat2, $lon2) {
     
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
      
      return ($miles * 1.609344 * 1000);
      }
     ?>      
