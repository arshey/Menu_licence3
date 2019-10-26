<nav id="nav">
    <ul>
        <li>
            <a <?php if ($page == "home") {
                    echo 'class="active"';
                    } else {
                        echo "";
                    } 
            ?> href="index.php" >
            Home
            </a>
        </li>
        <li><a <?php echo ($page == 'news' )? "class='active'" : "" ?>  href="news.php">News</a></li>
        <li><a <?php echo ($page == 'about' )? "class='active'" : "" ?>  href="about.php">About</a></li>
        <li><a <?php echo ($page == 'contact' )? "class='active'" : "" ?>  href="contact.php">Contact</a></li>
    </ul>
</nav>


<?php


