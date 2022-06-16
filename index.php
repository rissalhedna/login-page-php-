<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/CSS/Styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="position-fixed navbar bg-dark">
        <div class="navbar-logo text-light">
            Logo
        </div>
        <div class="menu-elements m-4 mt-0 ml-0 mb-0">
        <div class="d-flex flex-inline logout-btn">
            <?php
                if(isset($_SESSION["useruid"])){
                    echo "<li ><a href=\"includes/logout.inc.php\">Log out</a></li>";
                }
            ?>
        </div>
        </div>
    </nav>

    <section cl ass="first">
        <div class="container-fluid pt-5">
            <div class="container pt-5">
                <div class="row">
                    <div class="col col-12 col-sm-12 col-md-6 signin-form-container">
                        <form class="signin-form form-section" action="/includes/login.inc.php" method="post">
                            <h2 class="text-light">Sign in</h2>
                            <input name="uid" class="mb-2" placeholder="Username" type="text">
                            <input name="pwd" class="mb-2" placeholder="Password" type="text">
                            <button name="submit" type="submit" class="signin-btn button">Sign in</button>
                            <div>
                            <?php
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "wrongLogin"){
                                            echo "<p class=\"mt-3 ml-3 text-danger\">Wrong username or password!</p>";
                                        }
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-6 signup-form-container mt-3">
                        <form class="signup-form form-section" action="/includes/signup.inc.php" method="post">
                            <h2>Sign up</h2>
                            <input name="email" class="mb-2" placeholder="Email" type="text">
                            <input name="uid" class="mb-2" placeholder="Username" type="text">
                            <input name="pwd" type="password" class="mb-2" placeholder="Password" type="text">
                            <input name="pwdrepeat" type="password" class="mb-2" placeholder="Re-enter password" type="text">
                            <button name="submit" type="submit" class="signup-btn button">Sign up</button>
                            <div>
                                <?php
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "uidExists"){
                                            echo "<p class=\"mt-3 ml-3 text-danger\">Username already taken!</p>";
                                        }
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>