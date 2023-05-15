<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once 'header.php';

    // CHECK IF FILTERS ARE SET
    $categoryfilter = (isset($_GET['catfilter'])) ? $_GET['catfilter'] : '';
    $modelfilter = (isset($_GET['modelfilter'])) ? $_GET['modelfilter'] : '';
    $sortfilter = (isset($_GET['sortfilter'])) ? $_GET['sortfilter'] : '';
    $searchbarfilter = (isset($_GET['searchbarfilter'])) ? $_GET['searchbarfilter'] : '';
    

    $queryfilterarray = [1];
    if ($categoryfilter != null && $categoryfilter != 'categoryall') {
      array_push($queryfilterarray, $categoryfilter);
    }

    if ($modelfilter != null && $modelfilter != 'modelall') {
      array_push($queryfilterarray, $modelfilter);
    }

    if ($searchbarfilter != null && $searchbarfilter != '') {
      array_push($queryfilterarray, $searchbarfilter);
    }

    if ($sortfilter != null) {
      if($sortfilter == 'Newest') {
        $sortfiltervalue = 'DESC';
      } else if($sortfilter == 'Oldest') {
        $sortfiltervalue = 'ASC';
      }
    }

    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM prompts WHERE prompts.approved = ?" 
    . ($categoryfilter == null  || $categoryfilter == 'categoryall' ? '' : 'AND prompts.category = ?') 
    . ($modelfilter == null  || $modelfilter == 'modelall' ? '' : 'AND prompts.model = ?')
    . ($searchbarfilter == null  || $searchbarfilter == '' ? '' : 'AND prompts.name = ?')
    . 'ORDER BY prompts.created_at ' . ($sortfilter == null ? 'DESC' : $sortfiltervalue);

    $query = $db->prepare($query);
    $query->execute($queryfilterarray);
   

    $prompts = $query->fetchAll();

    $qry = "SELECT id, COUNT(*) FROM favorites GROUP BY id";
    $qry = $db->prepare($qry);
    $qry->execute();
    $results = $qry->fetchAll();

    if($qry->rowCount() > 0) {
      $favorites = array();
      foreach($results as $result){
          $favorites[$result[0]] = $result[1];
      }
    } else {
      $favorites = 0;
    }

    // GET FILTERS AND PUT THEM INTO DIFFERENT ARRAYS TO DISPLAY THEM
    $filterscategory = [];
    $filtersmodel = [];
    $filterssort = [];
    $qry = "SELECT * FROM filters";
    $qry = $db->prepare($qry);
    $qry->execute();
    $filterresult = $qry->fetchAll();
    foreach($filterresult as $fr){
      switch ($fr[1]) {
        case 'category':
          array_push($filterscategory, $fr[0]);
          break;
        case 'model':
          array_push($filtersmodel, $fr[0]);
          break;
        case 'sort':
          array_push($filterssort, $fr[0]);
          break;
        default:
      }
    }

    $db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>All prompts</title>
</head>
<body>
<aside>
    <div id="filters">
        <div class="titlesFilters">Sort by</div>
          <ul>
            <?php foreach ($filterssort as $filtersort) { ?>
              <li style="list-style: none;"><label class="sortfilter" id="<?php echo $filtersort; ?>" onclick="updateQuery(event, 'sort')"><?php echo $filtersort; ?></label></li>
            <?php } ?>
          </ul>
        <div class="titlesFilters">Model</div>
          <ul>
            <li><label class="modelfilter" id="modelall" onclick="updateQuery(event, 'model')">All</label></li>
            <?php foreach ($filtersmodel as $filtermodel) { ?>
              <li style="list-style: none;"><label class="modelfilter" id="<?php echo $filtermodel; ?>" onclick="updateQuery(event, 'model')"><?php echo $filtermodel; ?></label></li>
            <?php } ?>
          </ul>
        <div class="titlesFilters">Category</div>
        <ul>
          <li><label class="modelfilter" id="categoryall" onclick="updateQuery(event, 'category')">All</label></li>
          <?php foreach ($filterscategory as $filtercategory) { ?>
            <li style="list-style: none;"><label class="categoryfilter" id="<?php echo $filtercategory; ?>" onclick="updateQuery(event, 'category')"><?php echo $filtercategory; ?></label></li>
          <?php } ?>
        </ul>
    </div>
</aside>
<a id="home" href="homepage.php">home</a>
<div class="hottestPrompts" style="flex-wrap: wrap;">
  <?php foreach ($prompts as $prompt) { ?>
    
    <div style="display: flex;flex-direction: column;width: 300px;" onclick="window.location.href='prompt.php?id=<?php echo $prompt['id']; ?>'">
      <span><?php echo $prompt['name']; ?></span>
      <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
      <span style=""><?php echo $prompt['description']; ?></span>
      <span>cost: <?php echo $prompt['cost']; ?></span>
      <span>Favorites: <?php echo (isset($favorites[$prompt['id']])) ? $favorites[$prompt['id']] : 0;  ?></span>
    </div>
  <?php } ?>
</div>
<script>
// GET CURRENT SEARCH PARAMS
let searchParams = new URLSearchParams(window.location.search);
// FOR EACH FILTER PUT THE SELECTED ONE IN RED COLOR
if(searchParams.get('catfilter') !== null) {
  let element = document.getElementById(searchParams.get('catfilter'));
  element.style.color = 'red';
}
if(searchParams.get('modelfilter') !== null) {
  let element = document.getElementById(searchParams.get('modelfilter'));
  element.style.color = 'red';
}
if(searchParams.get('sortfilter') !== null) {
  let element = document.getElementById(searchParams.get('sortfilter'));
  element.style.color = 'red';
}
if(searchParams.get('searchbarfilter') !== null) {
  let element = document.getElementById('searchbarinput');
  element.value = searchParams.get('searchbarfilter');
}

// FROM EACH LIST ITEM, SET THE FILTER ACCORDING TO THEIR TYPE
function updateQuery(event, type) {
  let elementId = event.target.id;
  if(type === 'searchbar'){
    elementId = event.target.value;
  }

  const searchParams = new URLSearchParams(window.location.search);
  switch(type){
    case 'category':
      searchParams.set('catfilter', elementId);
      break;
    case 'model':
      searchParams.set('modelfilter', elementId);
      break;
    case 'sort':
      searchParams.set('sortfilter', elementId);
      break;
    case 'searchbar':
      searchParams.set('searchbarfilter', elementId);
      break;
  }

  // GO TO NEW WINDOW WITH UPDATED SEARCH PARAMETERS
  window.location.href = 'all-prompts.php?' + searchParams.toString();

}
</script>

</body>
</html>