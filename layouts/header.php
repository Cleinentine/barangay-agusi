<header>
    <div class="col">
        <h1><a href="./">BRGY AGUSI</a></h1>
    </div>

    <div class="col text-right">
        <nav class="header-nav">
            <ul>
                <li><a href="./"><span class="icon-margin-right-gap"><i class="fa-solid fa-house"></i></span>Home</a></li>

                <?php
                    if (!isset($_SESSION['id'])) {
                        ?>
                        
                        <li><a href="./sign-in.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-right-to-bracket"></i></span>Sign In</a></li>
                        <li><a href="./sign-up.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-user-plus"></i></span>Sign Up</a></li>
                        
                        <?php
                    } else {
                        if ($user['access_level'] == 2) {
                            ?> <li><a href="./admin.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-gauge-high"></i></span>Admin Panel</a></li> <?php
                        } else {
                            ?> <li><a href="./profile.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-circle-user"></i></span>My Profile</a></li> <?php
                        }

                        ?>
                        
                        <li>
                            <form action="app/logout.php" method="POST">
                                <button name="logout" type="submit"><span class="icon-margin-right-gap"><i class="fa-solid fa-right-from-bracket"></i></span>Sign Out</button>
                            </form>
                        </li>
                        
                        <?php
                    }
                ?>
            </ul>
        </nav>

        <div class="hamburger-menu" id="hamburger_menu">
            <div class="first-bar"></div>
            <div class="second-bar"></div>
            <div class="third-bar"></div>
        </div>
    </div>
</header>

<nav class='nav'>
    <ul>
        <li><a href="./"><span class="icon-margin-right-gap"><i class="fa-solid fa-house"></i></span>Home</a></li>
        
        <?php
            if (!isset($_SESSION['id'])) {
                ?>
                
                <li><a href="./sign-in"><span class="icon-margin-right-gap"><i class="fa-solid fa-right-to-bracket"></i></span>Sign In</a></li>
                <li><a href="./sign-up"><span class="icon-margin-right-gap"><i class="fa-solid fa-circle-user"></i></span>Sign Up</a></li>
                <li><a href="./forgot-password.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-circle-question"></i></span>Forgot Password</a></li>
                
                <?php
            } else {
                if ($user['access_level'] == 2) {
                    ?> <li><a href="./admin.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-gauge-high"></i></span>Admin Panel</a></li> <?php
                } else {
                    ?> <li><a href="./profile.php"><span class="icon-margin-right-gap"><i class="fa-solid fa-circle-user"></i></span>My Profile</a></li> <?php
                }

                ?>

                <form action="app/logout.php" method="POST">
                    <button name="logout" type="submit"><span class="icon-margin-right-gap"><i class="fa-solid fa-right-from-bracket"></i></span>Sign Out</button>
                </form>

                <?php
            }
        ?>
    </ul>
</nav>