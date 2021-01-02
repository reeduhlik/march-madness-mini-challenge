<?php include "connection.php";
$error = "";
$east = [
"1) Duke",
"2) Michigan St.",
"3) LSU",
"4) Virginia Tech",
"5) Miss. St.",
"6) Maryland",
"7) Louisville",
"8) VCU",
"9) UCF",
"10) Minnesota",
"11) Belmont/Temple",
"12) Liberty",
"13) Saint Louis",
"14) Yale",
"15) Bradley",
"16) NC Central/North Dakota St."
];
$south = [
"1) Virginia",
"2) Tennessee",
"3) Purdue",
"4) Kansas St.",
"5) Wisconsin",
"6) Villanova",
"7) Cincinatti",
"8) Ole Miss",
"9) Oklahoma",
"10) Iowa",
"11) Saint Mary's",
"12) Oregon",
"13) UC Irvine",
"14) Old Dominion",
"15) Colgate",
"16) Gardner-Webb"
];
$west = [
"1) Gonzaga",
"2) Michgan",
"3) Texas Tech",
"4) Florida St.",
"5) Marquette",
"6) Buffalo",
"7) Nevada",
"8) Syracuse",
"9) Baylor",
"10) Florida",
"11) Arizona St./Saint John's",
"12) Murray St.",
"13) Vermont",
"14) N. Kentucky",
"15) Montana",
"16) F. Dickinson/Prairie View"
];
$midwest = [
"1) North Carolina",
"2) Kentucky",
"3) Houston",
"4) Kansas",
"5) Auburn",
"6) Iowa St.",
"7) Wofford",
"8) Utah St.",
"9) Washington",
"10) Seton Hall",
"11) Ohio St.",
"12) New Mexico St.",
"13) Northeastern",
"14) Georgia St.",
"15) Abilene Christian",
"16) Iona"
];
$all = array_merge(array_merge(array_merge($east, $south), $west), $midwest);

if(isset($_POST['submit'])){
    if(time() < 1553184000){
    $selectedTeams = [];
    $selections = $_POST['team'];
    $name = $_POST['name'];
    $tiebreaker = $_POST['tiebreaker'];
    for($i = 0; $i < sizeof($selections); $i++){
        $selectedTeams[$i] = $all[$selections[$i]]; 
    }
    if(!empty($name) && sizeof($selections) == 6 && !empty($tiebreaker)){
        $q = "SELECT * from picks WHERE name='$name'";
        $res = mysqli_query($connection, $q);
        if(mysqli_num_rows($res) == 0){
            $q = "INSERT INTO picks(team1, team2, team3, team4, team5, team6, tiebreaker, name) VALUES ('$selectedTeams[0]', '$selectedTeams[1]', '$selectedTeams[2]', '$selectedTeams[3]', '$selectedTeams[4]', '$selectedTeams[5]', '$tiebreaker', '$name')";
            $res = mysqli_query($connection, $q);
            if($res){
                $str = $name . " has submitted their picks of " . print_r($selectedTeams, true);
                $q = "INSERT INTO activity(msg) VALUES ('$str')"; 
                $res = mysqli_query($connection, $q);
            }
        }else{
            $error = "Already an entry under this name.";
        }
    }else{
        $error = "Please make sure you have selected 6 teams and entered your name and tiebreaker points";
    }
    }else {
        $error = "Time's up!";
    }
}
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
   <h3>How to play: Select six NCAA teams.  Their tournament seeding is their point value for each game.  Ex: If you pick a 1 seed, you get 1 point for every game they win.</h3>
   <h6>If you have already made your selections, click <a href="sheet.php">here</a> to see the sheet.</h6>
   <h2><?php echo $error;?></h2>
   <form action="index.php" method="post">

   
   <div class="countdown">
                            <table class="countdown">
                                <tr>
                                    <th>DAYS</th>
                                    <th>HOURS</th>
                                    <th>MINUTES</th>
                                    <th>SECONDS</th>
                                </tr>
                                <tr>
                                    <td id="days">00</td>
                                    <td id="hours">00</td>
                                    <td id="minutes">00</td>
                                    <td id="seconds">00</td>
                                </tr>
                            </table>
                        </div>
                        <input type="text" placeholder="1) Enter your name" id="name" name="name">
                        <div class="container4">
                        <h4 id="selectMoreTeams">2) Select <span id="num">6</span> more teams</h4>
    <div class="column">
     <h2>East</h2>
      <?php
        for ($i=0; $i < 16; $i++) {
          echo '<div class="team"><label class="container">' . $east[$i] . ' 
  <input type="checkbox" name="team[]" value=' . $i . '>
  <span class="checkmark"></span>
</label></div>';
        }
      ?>
    </div>
    <div class="column">
     <h2>South</h2>
      <?php
        for ($i=0; $i < 16; $i++) {
          echo '<div class="team"><label class="container">' . $south[$i] . ' 
  <input type="checkbox" name="team[]" value=' . ($i+16) . '>
  <span class="checkmark"></span>
</label></div>';
        }
      ?>
    </div>
    <div class="column">
     <h2>West</h2>
      <?php
        for ($i=0; $i < 16; $i++) {
          echo '<div class="team"><label class="container">' . $west[$i] . ' 
  <input type="checkbox" name="team[]" value=' . ($i+32) . '>
  <span class="checkmark"></span>
</label></div>';
        }
      ?>
    </div>
    <div class="column">
     <h2>Midwest</h2>
      <?php
        for ($i=0; $i < 16; $i++) {
          echo '<div class="team"><label class="container">' . $midwest[$i] . ' 
  <input type="checkbox" name="team[]" value=' . ($i+48) . '>
  <span class="checkmark"></span>
</label></div>';
        }
      ?>
    </div>
    </div>
    <input type="number" name="tiebreaker" placeholder="3) Tiebreaker- Total Championship Points" id="tiebreaker">
     <input type="submit" name="submit" value="Submit Teams" id="submit">
      </form>
  </div>
         
       
  </div>
<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="index.js" type="text/javascript"></script>
  <script>
      var teamsSelected = 0;
      $("input[type='checkbox']").on("click", function(){
        if(this.checked){
            if(teamsSelected >= 6){
              this.checked = false;
       
          }else {
              teamsSelected++;
          }
        
        } else {
        teamsSelected--;
        }
        $("#num").html((6-teamsSelected));
          }
      );
setInterval(updateTimer, 1000);

            function updateTimer() {
                var currentTime = new Date();
                currentTime = currentTime.getTime() / 1000;
                var dueDate = new Date(2019, 2, 21, 9, 0, 0, 0).getTime() /1000;
                var diff = dueDate - currentTime;
                if (diff < 0) {
                } else {
                    var days = Math.floor(diff / (60 * 60 * 24));
                    var hours = Math.floor((diff - (days * (60 * 60 * 24))) / (60 * 60));
                    var minutes = Math.floor((diff - (days * (60 * 60 * 24) + hours * (60 * 60))) / (60));
                    var seconds = Math.floor((diff - (days * (60 * 60 * 24) + hours * (60 * 60) + minutes * 60)));
                }
                $("#days").html(days);
                $("#hours").html(hours);
                $("#minutes").html(minutes);
                $("#seconds").html(seconds);
            }
</script>
</body>
</html>
