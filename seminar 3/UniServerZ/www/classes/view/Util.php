<?php
/*Presents username if user is logged in*/
if($_SESSION['LogInSuccess'] == "Yes"){
	echo '<form action="includes/logout_action.php" method="post">'
	echo '<input type="submit" id="logoutButton" value="Logga ut"></form>';
	echo '<a id="loginButton" href="login.php"><strong>';
	echo "Inloggad som: ";
	echo $_SESSION['LoggedInAs'];
	echo "</strong></a>";
							}
                            /*Presents login button if no one is logged in*/
							else{
								echo '<a id="loginButton" href="login.php"><strong>Logga in</strong></a>';
							}
                            ?>
	}
							<!--Login field END-->
	
}