
<link rel="stylesheet" type="text/css" href="styles.css">


<?php
//List files in a directory and add paths to an array
echo "<head><title>No Experience Required</title><header style='font-family: \"Source Sans Pro\", Arial, Helvetica, sans-serif;'><h1>No Experience Required</h1><h3>by Will Zandler</h3></header>";
// include('header.php');
echo "</head>";
$host 	   = $_SERVER['HTTP_HOST'];
$site_name = dirname($_SERVER['SCRIPT_NAME']);
$doc_root  = $_SERVER["DOCUMENT_ROOT"];
// Load Image Path Array
$comicPaths = array();
$srcDir = getcwd()."/comics/";
// echo "scrDir:    ".$srcDir;
// echo "<br />Current: ".getcwd();
if ($handle = opendir($srcDir)) {
    // Loop over entries
    while (false !== ($entry = readdir($handle))) {
        // Ignore hidden files]
     	// echo "<br />Entry:".$entry;
        if($entry[0] != "."){
        	// Only add comics before the current date:
        	// echo str_replace("_", "", $entry). " <= " .  date("mdY");
        	if (str_replace("_", "", substr($entry,0,10)) <= date("mdY")){	
				// Add to path array
        		array_push($comicPaths, $entry);
        	}
        	
        }
    }
    closedir($handle);
}
sort($comicPaths);
// print_r($comicPaths);
// Process and assign Variables
if($_GET['comic']=="current" || !isset($_GET['comic'])){
	$activeComic = count($comicPaths)-1;
}
else {
	$activeComic = $_GET["comic"];
}
$date = str_replace("_","/",substr($comicPaths[$activeComic],0,10));
//Display image from path array
echo '<table class="box" >';
echo "<tr>";	
	// Display comic publish date
	echo "<td><h2 style='color: rgb(200,15,15); text-align:left; '>".$date."</h1>";
	// Display comic
	echo "<img src=\"http://".$host.$site_name."/comics/".$comicPaths[$activeComic]."\" width=700px>";
	// echo "<img src=/comics/".$comicPaths[$activeComic] ."\" width=700px/>";
	// Set View Properties
	if($activeComic == 0){
		$backtrack = "hidden";
	}
	if($activeComic == (count($comicPaths)-1)){
		$advance = "hidden";
	}
	// Display navigation bar
	echo '<nav>';
	echo '<h1 style="border-top:solid 1px silver;"></h1>';
	// Nav First Button
	echo '<div class="nav-first"><a href="http://'.$host.$site_name.'?comic=0">first</a></div>';
	// Nav Back
	echo '<div class="nav-back" style="visibility:'.$backtrack.';"><a href="http://'.$host.$site_name.'/index.php?comic='.($activeComic-1).'">Back</a></div>';
	// Nav Random
	echo '<div class="nav-random"><a href="http://'.$host.$site_name.'/index.php?comic='.rand(0,(count($comicPaths)-1)).'">Random</a></div>';
	// Nav Forward
	echo '<div class="nav-forward" style="visibility:'.$advance.';"><a href="http://'.$host.$site_name.'/index.php?comic='.($activeComic+1).'">forward</a></div>';
	// Nav First Button
	echo '<div class="nav-current"><a href="http://'.$host.$site_name.'/index.php?comic=current">Current</a></div>';
	echo '</nav></h2>';
	
?>
<br /><br />
<footer style="font-size: 20;">Published M-Th in the Daily Wildcat</footer>