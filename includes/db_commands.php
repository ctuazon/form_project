<?PHP 

require_once ('constants.php');



// There isn't much sterilization going on. Apparently, prepared statements are more than enough to protect against SQL injection
// Use this to search for something in the database using its id
function SelectBlog ()
{
	$count = 0;
	$array = '';
	try 
	{
		// First Connect to the database
		$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=". DB_NAME . ";charset=utf8" , DB_USER, DB_PASS);
	}
	catch (PDOException $e)
	{
		echo "Error Connecting to Source:" . $e->getMessage();
	}
	
	$pdo->exec("set names utf8");		// Added for security
	
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
	$sth = $pdo->query("SELECT * FROM formdata");
	$sth->setFetchMode(PDO::FETCH_ASSOC);

	$result = $sth->fetchAll();
	 
	return $result;	// Everything in the array gets pushed to this return value
}

// This is used for SELECT, INSERT, UPDATE, DELETE operations
function InsertBlog($name, $email, $numcards, $typecards, $rewardsgood,  $oftencards, $comments)
{	
	// First Connect to the database
	$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=". DB_NAME . ";charset=utf8" , DB_USER, DB_PASS);
	 
	$pdo->exec("set names utf8");		// Added for security
	
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	try
	{
		// Insert into the Blog Database
		$sth = $pdo->prepare("INSERT INTO formdata ( name, email, numcards, typecards, rewardsgood, oftencards, comments) 
			VALUES(:name, :email, :numcards, :typecards, :rewardsgood, :oftencards, :comments)");
		
		// The values
		$sth->execute(array(
		
			"name" => $name,
			"email" => $email,
			"numcards" => $numcards,
			"typecards" => $typecards,
			"rewardsgood" => $rewardsgood,
			"oftencards" => $oftencards,
			"comments" => $comments
			));
			
	}
	catch(PDOException $e)
	{
		// Report an error
		echo $e->getMessage();
	}
	
	// Clear everything
	$pdo = null;
	$sth = null;
}


function PreparedDeleteBlog ($ContentId)
{
	// First Connect to the database
	$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=". DB_NAME . ";charset=utf8" , DB_USER, DB_PASS);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	try
	{
		$sth = $pdo->prepare("DELETE FROM formdata
							WHERE id = :id") ;
			
		$sth->execute(array(
			
				"id" => $ContentId
				
				));
	}
	catch(PDOException $e)
	{
		// Report an error
		echo $e->getMessage();
	}
	
	// Clear Everything
	$pdo = null;
	$sth = null;
}

?>