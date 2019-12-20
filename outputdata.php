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
			//echo "<div id='".$id."'>".$id."</div>";
		}
		else
		{
			switch ($key)
			{
				case "name":
					$key = "Name";
					break;
				case "email":
					$key = "Email";
					break;
				case  "numcards":
					$key = "Number Of Cards";
					break;
				case  "typecards":
					$key = "Type Of Cards";
					break;
				case  "rewardsgood":
					$key = "Are Rewards Good?";
					break;
				case  "oftencards":
					$key = "Do you use it Online?";
					break;
				case  "comments":
					$key = "Comments";
					break;
				default:
					$key = "error";
				
			}
			
			echo "<div id='values'>";
				echo "<div id='left'>". $key ."</div><div id='right'> ".$out . "</div>";
			echo "</div>";
		}
	}
		echo "<div id ='deletetrigger'>";
			echo 	'<a href="#" class="winter" id="'.$id.'">Delete</a>';
		echo "</div>";
	echo "</div>";
}


?>

<script>
$(document).ready(function() 
{
	// delete user
	$('.winter').click(function(event)
	{
		event.preventDefault();
	
		var process = confirm("Do you wish to delete this user?");
	
		var id = $(this).attr('id');
	
		//if(id == '1')
		if (process)
		{
		
			
			$.ajax({
				type: 'post',
				url: 'deleteuser.php',
			
				data: {
					id1:id
				},
				
				success: function (response) 
				{
				
					console.log("USER DEAD");
				}
			
				
			});
		}
		else
		{
			//redirect
		}
	});
});
</script>