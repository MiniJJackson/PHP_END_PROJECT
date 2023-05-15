<header>
  <nav>
		<div id="logo" onclick=""><a href="homepage.php">FairlyPrompts</a></div>
		<div id="searchbar">
			<input type="text" id="searchbarinput" placeholder="Search prompts..."  onchange="updateQuery(event, 'searchbar')"> 
		</div>
    <?php session_start(); ?>

    <?php echo isset($_SESSION['username']) && $_SESSION['role'] === 'admin' ? '<a href="admin-prompts.php">Admin prompts</a>' : '' ?>
    
    <a href="my-prompt.php">My Prompts</a>
    <?php echo isset($_SESSION['username']) ? "(" . $_SESSION['username'] . ')<a id="logout" href="logout.php">Logout</a>' : '<a id="login" href="login.php">Login</a>' ?>
	</nav>
</header>


