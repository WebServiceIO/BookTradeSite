<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange</title>
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="includes/css/main.css">
    <link rel="stylesheet" href="includes/css/navbar.css">

    <!-- JavaScript -->
    <script type="text/javascript" src="includes/js/sticky-top.js"></script>
    
    <!-- FakeLoader -->
    <link rel="stylesheet" href="bower_components/fakeLoader/fakeLoader.css">
    <script src="bower_components/fakeLoader/fakeLoader.min.js"></script>
</head>
<body>
    
    <div id="fakeLoader"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">bookXchange</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="my-nav">
                <ul class="nav navbar-nav navbar-right">

                    <?php

                    header('Cache-Control: no-cache, no-store, must-revalidate');

                    require_once('includes/php/db_helper.php');
                    $db = new db_helper();
                    session_start();

                    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
                    {
                        if(strcmp($db->getFingerprintInfoFromId($_SESSION['USER_ID']), $_SESSION['FINGER_PRINT']) == 0)
                        {
                            echo '<p>Welcome ' . $db->getFName($_SESSION['USER_ID']) . '</p>';
                            echo '
                                <a href="logout.php">
                                    <button type="button" class="navbar-btn">
                                        Log out
                                    </button>
                                </a>
                            ';
                        }
                    }
                    else
                    {
                        echo '
                                <a href="login.php">
                                    <button type="button" class="navbar-btn">
                                        Log In
                                    </button>
                                </a>
                                <a href="register.php">
                                    <button type="button" class="navbar-btn">
                                        Register
                                    </button>
                                </a>
                        ';
                    }
                        ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- User Input Container-->
    <div class="parallax">
        <div id="wrapper-form">
            <form class="wrapper-form" action = "searchByISBN.php" method = "POST">
                <div id="button-search"></div>
                <input type="text" name = "isbn" placeholder="Find your perfect book here...">
                <div id="vertical-line"></div>
                <div class="select-style">
                    <select>
                        <option value="isbn" selected>ISBN</option>
                        <option value="class">Class Number</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- How It Works -->
    <div class="outer">
        <div class="inner">
            <span class="section-header">How to Xchange</span>
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
            <br>
            hwa
            <br>
            seg
            <br>
            sefes
            <br>
            seges
        </div>
    </div>

    <!-- Why Use This -->
    <div class="outer">
        <div class="inner">
            <span class="section-header">Why Use It?</span>
        </div>
    </div>

    <!-- Send Us Feedback -->
    <div class="outer">
        <div class="inner">
            <span class="section-header">Send Us Feedback</span>
        </div>
    </div>
    
    <!-- Initialize fakeLoader -->
    <script type="text/javascript">
        $("#fakeLoader").fakeLoader({
            timeToHide: 2000, // fakeLoader time (ms)
            spinner:"spinner1", // Options: 'spinner1' to 7
            bgColor:"#2ecc71", //Hex, RGB or RGBA colors
        });
    </script>

</body>
</html>
