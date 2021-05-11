<?php
   include "config.php";
   include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <!-- Bootstrap CSS -->
    <link media="screen and (max-device-width: 799px)" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>URL Shortener</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Fun-Size URL Shortener</h1>
    <form action="index.php" method="post" class="center-content">
        <input type="text" name="url" placeholder="Enter any url" required>
        <button type="submit" name="submit">Click to shorten</button>

        <div style="font-weight: bold;width: 100%;">
    <?php
       if(isset($_POST["submit"])){
           $input = $_POST["url"];
           $check = mysqli_query($con, "SELECT long_url FROM short_url WHERE long_url = '$input'");
           $result = mysqli_fetch_assoc($check);
           $url = $base . '/' . $ran_url;
           $sql = mysqli_query($con, "INSERT short_url (id, long_url, shorten_url) VALUES ('$ran_url', '$input', '$url')");
           if($sql){
               echo "Your shortened URL is: <a href=" .$url. ">" .$url. "</a>";
            }else{
               echo "There is something wrong while inserting the data into database";
            }
        }
        if(isset($_GET['redirect']) || !empty($_GET['redirect'])){
            $ran_url = $_GET['redirect'];
            $sql2 = mysqli_query($con, "SELECT long_url FROM short_url WHERE id = '$ran_url'");
            $row = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
            if(mysqli_num_rows($sql2) > 0){
                $redirect = $row['long_url'];
                header("Location:" .$redirect);
            }else{
                header("Location: index.php");
            }
        }
    ?>
    </div>
    </form>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>