<?php
if (isset($_GET['city'])) {
    $city = str_replace(" ", "", $_GET['city']);

    $urlcontents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $city . ",uk&appid=08357e95205b5aaa9fe251f2bc7f70e7");

    $weatherArray = json_decode($urlcontents, true);

    if ($weatherArray['cod'] == 200) {
        $weather = "The Weather in " . $city . " is currently '" . $weatherArray['weather'][0]['description'] . "'. ";
        $temp = intval($weatherArray['main']['temp'] - 273);
        $weather.="The Temperature is " . $temp . "&deg;c and the Wind Speed is " . $weatherArray['wind']['speed'] . "m/s.";
    } else {
        $error = "Your City Could Not Found";
    }
   
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" >
        <style>

            body{

                background: url("weather.jpg");

            }

            .container{
                margin-top: 100px;
                width:400px;
                text-align: center;
                color:white;
            }
            #city{
                margin-top: 20px;
            }

            #submit{
                margin-bottom:20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>What's the weather?</h1>
            <form method="get">
                <div class="form-group">
                    <label for="city">Enter The Name Of City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Eg:London,Tokyo" value="<?php
                    if (isset($_GET['city'])) {
                        echo $_GET['city'];
                    }
                    ?>" required />
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>

                <?php
                if (isset($weather)) {

                    echo '<div class="alert alert-success" role="alert">' . $weather . '</div>';
                } elseif (isset($error)) {
                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                }
                ?>
            </form>
        </div>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
    </body>
</html>
