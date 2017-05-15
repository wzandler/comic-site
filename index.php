 <!-- Set Comic vars and links -->
<?php
    $activeComic = 0;
    $date = 0;
    $comicPaths = array();

    echo "$comicDir";
    if ($handle = opendir("comics/")) {
        while (false !== ($entry = readdir($handle))) {
            if($entry[0] != "."){
                // echo str_replace("_","",substr($entry,0,10))."<br />";
            	if (str_replace("_","",substr($entry,0,10)) <= date("Ymd")){
                    // echo substr($entry,6,4).substr($entry,0,2).substr($entry,3,2)." < ".date("Ymd").  "<br />";
            		array_push($comicPaths, $entry);
            	}
            }
        }
        closedir($handle);
    }
    sort($comicPaths);
    // print_r($comicPaths);


    if($_GET['comic']>=count($comicPaths) || !isset($_GET['comic'])){
        $activeComic = count($comicPaths)-1;
    }
    else {
        $activeComic = $_GET["comic"];
    }
    $comic = $comicPaths[$activeComic-1];
   
    $date = substr($comic,5,2)."/".substr($comic,8,2)."/".substr($comic,0,4);

    $current = count($comicPaths);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>No Experience Required</title>
        <link rel="stylesheet" href="styles.css" media="screen" title="no title" charset="utf-8">
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <!-- Google Analytics  -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-72228398-1', 'auto');
          ga('send', 'pageview');

        </script>

    </head>


    <body>


        <div id="wrapper">
            <header>
                <h1>No Experience Required</h1>
                <h3>by Will Zandler</h3>
            </header>
            <div id="content">
                <div class="intro">
                    <p>A web comic about Nate and Hector, two guys and their adventures in college.</p>
                </div>
                <div class="cTitle">
                    <h2 id="date"><?php echo $date ?></h2>
                </div>
                <div id="comic-wrapper">
                    <div >
                        <img id="comic" src="/comics/<?php echo $comic ?>" alt="" />
                    </div>
                    <div class="comic-nav">
                        <ul>
                            <li id="first" <?php if($activeComic == 1){echo "class='hide'"; } ?>><a href="?comic=1"><< First</a></li>
                            <li id="back" <?php if($activeComic == 1){echo "class='hide'"; } ?>><a href="?comic=<?php echo ($activeComic-1)?>">Back</a></li>
                            <!-- <li id="back"><a href="#">Back</a></li> -->
                            <li id="random"><a href="?comic=<?php echo rand(1,$current)?>">Random</a></li>
                            <li id="forward" <?php if($activeComic == $current){echo "class='hide'"; } ?>><a href="?comic=<?php echo ($activeComic+1)?>">Forward</a></li>
                            <li id="current" <?php if($activeComic == $current){echo "class='hide'"; } ?>><a href="?comic=<?php echo count($comicPaths)?>">Current</a></li>
                        </ul>
                    </div>
                </div>
                <div id="about">
                    <p id="published">
                        No Experience Required is published in the <a id="wildcat" href="http://www.wildcat.arizona.edu/">Daily Wildcat</a> every Monday, Wednesday, and Friday.
                    </p>
                    <div class="me">
                        <h3>About the artist</h3>
                        <img id="profile_pic" src="will.jpg" alt="Will Zandler" />
                        <p id='bio'>
                            Will Zandler is a cartoonist, programmer, and electronics hobbyist in Tucson, Arizona.  He is currently a student at the University of Arizona where he began drawing cartoons for the Daily Wildcat in 2015.  In his free time he likes to rollerblade and explore entreprenerual opportunities.
                        </p>
                    </div>
                    <!-- <div class="links">
                        <h3>Other links:</h3>
                        <ul>
                            <li></li>
                        </ul>
                    </div> -->

                </div>
            </div>
            <footer>
                <div class="copyright">
                    &copy; Will Zandler <?php echo date("Y") ?>
                </div>
            </footer>
        </div>
    </body>
</html>
