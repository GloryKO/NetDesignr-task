

  <div id="primary" class="content-area">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <main id="main" class="site-main">

      <?php
      $curl = curl_init();

      curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://api.pandascore.co/leagues",
        CURLOPT_URL =>"https://api.pandascore.co/matches/upcoming?page[size]=5&sort=scheduled_at",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer bjczPvZIUy60H2cYgafLr4jGk8M_4K5EZJyPLb0ioA_KhInQbMo',
            'Content-Type: application/json'
          ),
      ));

      $response = curl_exec($curl);
      //echo($response);
      $err = curl_error($curl);
      curl_close($curl);
      

      //print any error message gotten on request
      if ($err) {
        if ($debug) echo "cURL Error #:" . $err;
        else echo "Oops, something went wrong.  Please try again later.";
      }

        //Create an array of objects from the JSON returned by the API
          $jsonObj = json_decode($response, true);

  
        ?>
        
        <div class="w3-row w3-center w3-margin "><?php // get the first two games ?>
                <div class="w3-col s2 "> <?php echo $jsonObj[0]["name"] ? : "can't find team name";?> </div> 
                <div class="w3-col s2 "> <?php echo $jsonObj[1]["name"] ? : "can't find team name";?> </div>
        </div>

         <?php  //iterate the array of objects and get the needed information. return the given message if not data is returned.

         foreach($jsonObj as $showObj){
         ?>
        
            <div class="w3-row w3-center w3-margin ">
                <div class="w3-col s2 "> <?php echo $showObj["name"] ? : "can't find team name";?> </div>
                <div class="w3-col  s2"> <?php echo date($showObj["begin_at"]? : "Can't find the time for now");?> </div>
                <div class="w3-col   s2"> <?php echo $showObj["opponents"][1]["opponent"]["image_url"]? : "Cant find image_url";?> </div><br>
                <div class="w3-col  s2"> <?php echo $showObj["opponents"][0]["opponent"]["image_url"]? : "cant find image_url";?> </div>
            </div>
      <?php };?>

   
   

