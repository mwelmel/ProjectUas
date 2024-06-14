<?php

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit(); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_acc.php' ?>

<section class="inbox">

   <h1 class="heading">Inbox</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
            $select_active_posts->execute([$admin_id, 'active']);
            $numbers_of_active_posts = $select_active_posts->rowCount();
         ?>
         <h3><?= htmlspecialchars($numbers_of_active_posts, ENT_QUOTES, 'UTF-8'); ?></h3>
         <p>Active Posts</p>
         <a href="view_posts.php" class="btn">See Posts</a>
      </div>

      <div class="box">
         <?php
            $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
            $select_deactive_posts->execute([$admin_id, 'deactive']);
            $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
         ?>
         <h3><?= htmlspecialchars($numbers_of_deactive_posts, ENT_QUOTES, 'UTF-8'); ?></h3>
         <p>Deactive Posts</p>
         <a href="view_posts.php" class="btn">See Posts</a>
      </div>

      <div class="box">
         <?php
            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
            $select_likes->execute([$admin_id]);
            $numbers_of_likes = $select_likes->rowCount();
         ?>
         <h3><?= htmlspecialchars($numbers_of_likes, ENT_QUOTES, 'UTF-8'); ?></h3>
         <p>Total Likes</p>
         <a href="view_posts.php" class="btn">See Posts</a>
      </div>

   </div>

</section>

<div id="menu-btn" class="fas fa-bars"></div>

</body>
</html>
