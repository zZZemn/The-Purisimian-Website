<?php
include('db/class.php');
$db = new admin_class();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/styles.css" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
  <title>The Purishmian | Articles</title>
</head>

<body>
  <a href="login.php" class="btn-login">
    <i class="fa-solid fa-user-tie"></i>
    <span>Admin</span>
  </a>
  <nav class="nav-container container d-flex justify-content-between align-items-center p-3">
    <a href="index.html"><img src="assets/logo.png" class="logo" /></a>
    <ul class="nav nav-ul">
      <li class="nav-item">
        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
      </li>
      <li class="nav-item">
        <a href="articles.php" class="nav-active"><i class="fa-solid fa-newspaper"></i> Articles</a>
      </li>
      <li class="nav-item">
        <a href="projects.html"><i class="fa-solid fa-diagram-project"></i> Projects</a>
      </li>
      <li class="nav-item">
        <a href="about.html"><i class="fa-solid fa-info"></i> About us</a>
      </li>
      <li class="nav-item">
        <a href="contact.html"><i class="fa-solid fa-address-book"></i> Contacts</a>
      </li>
    </ul>
    <button type="button" id="navButton">
      <i class="fa-solid fa-bars" id="navButtonIcon"></i>
    </button>
  </nav>

  <div class="container mb-5 d-flex flex-wrap justify-content-between align-items-center">
    <?php
    $getArticles = $db->getArticles();
    if ($getArticles->num_rows > 0) {
      while ($article = $getArticles->fetch_assoc()) {
    ?>
        <div class="card-content-container card mt-5">
          <img class="card-img-left" src="assets/articles/<?= $article['PHOTO'] ?>" alt="Card image cap" />
          <div class="card-body">
            <h5 class="card-title"><?= $article['CATEGORY'] ?></h5>
            <h5 class="card-text">
              <?= $article['TITLE'] ?>
            </h5>
            <p class="card-text">
              <?= $article['ARTICLE'] ?>
            </p>
            <a href="#" class="btn-go-sw btn">Visit</a>
          </div>
        </div>
      <?php
      }
    } else {
      ?>
      <center>No article found.</center>
    <?php
    }
    ?>
    <!-- <div class="card-content-container card mt-5">
        <img
          class="card-img-top"
          src="assets/articles/feature.jpeg"
          alt="Card image cap"
        />
        <div class="card-body">
          <h5 class="card-title">Feature</h5>
          <h5 class="card-text">
            Life's Curiosities Unveiled: Tales That Will Leave You Spellbound!
          </h5>
          <p class="card-text">
            In the hustle and bustle of our modern lives, it's all too easy to
            get caught up in the monotony of routine and lose sight of the
            extraordinary wonders that surround us. But what if we could awaken
            our senses, cultivate curiosity, and rediscover the magic hidden
            within the fabric of everyday life?
          </p>
          <a href="#" class="btn-go-sw btn">Visit</a>
        </div>
      </div>
      <div class="card-content-container card mt-5">
        <img
          class="card-img-top"
          src="assets/articles/sci-tech.jpg"
          alt="Card image cap"
        />
        <div class="card-body">
          <h5 class="card-title">Science and Technology</h5>
          <h5 class="card-text">
            DO No. 49: Paving the Way for Educational Progress or Hindering
            Teacher Autonomy?
          </h5>
          <p class="card-text">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos
            corporis culpa, temporibus beatae nisi itaque labore ea. Tempora
            fuga suscipit ad quia ipsa itaque temporibus, similique aliquam.
            Voluptas, eligendi aliquam id natus incidunt odio vitae voluptatem
            quae placeat accusamus corporis obcaecati laudantium possimus
            assumenda quis doloribus impedit ipsa provident unde architecto
            suscipit!
          </p>
          <a href="#" class="btn-go-sw btn">Visit</a>
        </div>
      </div>
      <div class="card-content-container card mt-5">
        <img
          class="card-img-top"
          src="assets/articles/sports-article1.jpeg"
          alt="Card image cap"
        />
        <div class="card-body">
          <h5 class="card-title">Sports</h5>
          <h5 class="card-text">
            DO No. 49: Paving the Way for Educational Progress or Hindering
            Teacher Autonomy?
          </h5>
          <p class="card-text">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos
            corporis culpa, temporibus beatae nisi itaque labore ea. Tempora
            fuga suscipit ad quia ipsa itaque temporibus, similique aliquam.
            Voluptas, eligendi aliquam id natus incidunt odio vitae voluptatem
            quae placeat accusamus corporis obcaecati laudantium possimus
            assumenda quis doloribus impedit ipsa provident unde architecto
            suscipit!
          </p>
          <a href="#" class="btn-go-sw btn">Visit</a>
        </div>
      </div> -->
  </div>

  <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
  <script src="javascript/app.js"></script>
</body>

</html>