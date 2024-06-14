<?php
if (isset($messages)) {
    foreach ($messages as $msg) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">
    <a href="inbox.php" class="logo">Admin<span>Panel</span></a>

    <div class="profile">
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
    </div>

    <nav class="navbar">
        <a href="inbox.php"><i class="fas fa-home"></i> <span>home</span></a>
        <a href="view_posts.php"><i class="fas fa-eye"></i> <span>view posts</span></a>
    </nav>
</header>

<div id="menu-btn" class="fas fa-bars"></div>
