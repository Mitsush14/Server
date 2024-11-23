<?php
function listDirectory($dir) {
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );

    $allowedImages = array('gif', 'png', 'jpg', 'jpeg', 'zip', '7z');
    $allowedVideos = array( 'mp4', 'avi', 'mkv');
    if (is_dir($dir)) {
        $items = scandir($dir);
        echo "<div id=\"content\">";
        echo "<ul id = \"thumbs2\">";
        foreach ($items as $item) {
            if ($item != "." && $item != "..") {
                $path = $dir . DIRECTORY_SEPARATOR . $item;
                $path = strtr( $path, $unwanted_array );
                if (is_dir($path) && $item != 'css') {
                    $item = strtr( $item, $unwanted_array );
                    echo "<li><a href='?dir=" . urlencode($path) . "'>$item/</a></li>";
                } else {
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if(in_array($ext, $allowedImages)){
                        if($dir != '.'){
                            $item = $dir . DIRECTORY_SEPARATOR . $item;
                        }
                        $item = strtr( $item, $unwanted_array );
                        echo "<li>
                        <div class=\"image\">
                        <a href='$item'\">
                        <img src='$item'>
                        </a>
                        </li>";
                    }
                    if(in_array($ext, $allowedVideos)){
                        $link = $dir . DIRECTORY_SEPARATOR . $item;
                        $link = strtr( $link, $unwanted_array );
                        /*if($ext == 'mkv'){
                            echo "
                            <li>
                                <div class=\"video\">
                                    <video controls>
                                        <source src='$link' type=\"video/mp4\">
                                    </video>
                                </div>
                            </li>";
                        }
                        else{
                            */
                            echo "<li>
                            <div class=\"video\">
                            <a href='$link'\">$item
                            </a>
                            </li>";
                        //}
                    }
                }
            }
        }
        echo "</ul>";
    } else {
        echo "<p>Le chemin spécifié n'est pas un dossier valide.</p>";
    }
}

$dir = isset($_GET['dir']) ? urldecode($_GET['dir']) : '.';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Explorateur de fichiers</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h1>Explorateur de fichiers</h1>
    <p>Chemin actuel : <?php echo htmlspecialchars($dir); ?></p>
    <?php listDirectory($dir); ?>
</body>
</html>