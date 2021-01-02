<?php include "connection.php";
$error = "";
$q= "SELECT * from picks";
$res = mysqli_query($connection, $q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>The Superior Six - March Madness Pool</title>
  <link rel="stylesheet" href="index.css" type="text/css">
</head>
<body>

  <div class="container2">
  <div class="container3">

   <h1>March Madness Pick Six Pool</h1>
   <h2><?php echo $error;?></h2>
   <table id="sheet">
      <tr>
       <th>Name</th>
       <th>Team 1</th>
       <th>Team 2</th>
       <th>Team 3</th>
       <th>Team 4</th>
       <th>Team 5</th>
       <th>Team 6</th>
       </tr>
       <?php
          while($row = mysqli_fetch_assoc($res)){
              echo "<tr><td>" . $row['name'] . "</td><td>" . $row['team1'] . "</td><td>" . $row['team2'] . "</td><td>" . $row['team3'] . "</td><td>" . $row['team4'] . "</td><td>" . $row['team5'] . "</td><td>" . $row['team6'] . "</td></tr>";
              
          }
          ?>
   </table>
    </div>
  </div>
<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="index.js" type="text/javascript"></script>
</body>
</html>
