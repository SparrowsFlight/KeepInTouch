<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />

        <title>
            KeepInTouch - <?= htmlspecialchars($title) ?>
        </title>

    </head>

    <body>

        <div class="container-fluid text-center page-holder">

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">KeepInTouch</a>
                    </div>

                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <?php if ($user != false): ?>
                            <li><a href="logout.php">Logout</a></li>
                            <li><a href="newpost.php">New Post</a></li>
                            <li><a href="userhome.php?u=<?= $user->getId() ?>">My Page</a></li>
                        <?php endif; ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><p class="navbar-text"><?= $user == false ? "Not Logged In" : "Logged In As User " . $user->getUsername() ?></p></li>
                    </ul>

                </div>
            </nav>

            <div class="row">

                <h1>KeepInTouch</h1>

            </div>

            <hr />