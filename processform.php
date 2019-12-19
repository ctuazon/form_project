<?PHP
require_once ('includes/db_commands.php');

$name = $_POST['name1'];
$email = $_POST['email1'];
$numcard = $_POST['numcards1'];
$typecards = $_POST['typecards1'];
$rewardsgoods = $_POST['rewardsgoods1'];
$oftencards = $_POST['oftencards1'];
$comments = $_POST['comments1'];


$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, "name:".$name." email:".$email." numberCards: ".$numcard." typeCard:".$typecards." Rewards:". $rewardsgoods." often:".$oftencards." comments:".$comments);

fclose($myfile);
			
InsertBlog($name, $email, $numcard, $typecards, $rewardsgoods,  $oftencards, $comments)
?>