<header>
  <nav>
		<div id="logo" onclick=""><a href="homepage.php">FairlyPrompts</a></div>
    <?php if(str_contains($_SERVER['REQUEST_URI'], 'all-prompts')): ?>
      <div id="searchbar">
        <input type="text" id="searchbarinput" placeholder="Search prompts..."  onchange="updateQuery(event, 'searchbar')"> 
      </div>
    <?php endif; ?>
    <div class="navLinks">
    <?php session_start(); ?>

    <?php echo isset($_SESSION['username']) && $_SESSION['role'] === 'admin' ? '<a href="admin-prompts.php">Admin prompts</a>' : '' ?>
    
    <a href="my-prompt.php">My Prompts</a>
    <?php echo isset($_SESSION['username']) ? "(<a href='user-profile.php?user_id=" . $_SESSION['user_id'] . "'>" . $_SESSION['username'] . '</a>)<a id="logout" href="logout.php">Logout</a>' : '<a id="login" href="login.php">Login</a>' ?>
    </div>
  </nav>
</header>


