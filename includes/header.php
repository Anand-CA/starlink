<?php
echo '<nav>
    <h1>StarLink</h1>

    <ul>
        
     
        <li>
        <a href="dashboard.php">
            home
        </a>
        </li>
        <li>about us</li>
        <li>
            <a href="upload.php">
                upload file
            </a>
        </li>
        <li>
        <a href="./admin/home.php">admin</a>
    </li>
        <li>Welcome, '.$_SESSION["user_name"].'</li>
        <li>
            <form action="" method="GET">
                <button class="logout-btn" name="logout-btn">
                    log out
                </button>
            </form>
        </li>
    </ul>
</nav>';
?>