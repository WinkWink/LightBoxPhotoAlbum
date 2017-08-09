<!DOCTYPE html>
<html>
<head>
    <title>Photo Album</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="lightbox.js"></script>
    <link href="lightbox.css" rel="stylesheet">
</head>
<body>
<?php
$page = $_SERVER['PHP_SELF'];

//settings
$column = 5;

//directories
$base = "data";
$thumbs = "thumbs";

// get album
$get_album = $_GET['album'];

if (!$get_album){
    echo "<b>Select an album:</b><p />";
    $handle = opendir($base);
    while (($file = readdir($handle)) !==FALSE){
        if(is_dir($base."/".$file) && $file != "." && $file !=".." && $file != $thumbs){
            echo "<a href='$page?album=$file'>$file</a><br>";
        }
    }
}
else{
    if(!is_dir($base."/".$get_album) || strstr($get_album,".") != NULL || strstr($get_album,"/") != NULL || strstr($get_album,"\\") != NULL){
        echo "Albumn does not exist";
    }else{
        $x =0;
        echo "<b>$get_album</b><p/>";
        $handle = opendir($base."/".$get_album);
        while (($file = readdir ($handle))!== FALSE){
            if ($file != "." && $file != ".."){
                echo "<table style='display:inline'><tr><td><a href='$base/$get_album/$file' rel='lightbox'><img src='$base/$thumbs/$file'></a></td></tr></table>";
                $x++;
                if ($x==$column){
                    echo "<br>";
                    $x = 0;
                }
            }
        }
        closedir($handle);
        echo "<p /><a href='$page'>Back</a>";
    }
}


?>


</body>
</html>