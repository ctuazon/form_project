<?PHP
require_once ('includes/db_commands.php');

$id = "";
foreach (SelectBlog() as $output)
{
	echo "<div id='users'>";
	foreach ($output as $key => $out)
	{
		if ($key == 'id')
		{	
			$id = $out;
		}
		else
		{	
			echo "<div id='values'>";
				echo "<div id='left'>". $key ."</div><div id='right'> ".$out . "</div>";
			echo "</div>";
		}
	}
	echo "<a href ='delete.php?id=".$id."'>Delete</a><br/>";
	echo "</div>";
}


?>