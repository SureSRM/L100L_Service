<li class="list-group-item">

  <div class="media">
    <div class="media-left">
      <img src="pics/<?= $story['genre']?>.png" class="media-object" style="width:60px">
    </div>
    <div class="media-body">
      <h3 class="media-heading">
        <a href='story/<?= $story['id'] ?>'>
          <?= $story['title'] ?>
        </a>
        <small> by <a href='user.php?user=<?= $story['author'] ?>'><?= $story['author'] ?></a>
        </small>
        <a href='like.php?story_id=<?=$story['id']?>&username=<?=$_SESSION['login_user']?>'> 🖒 </a>

      </h3>

      <p>Likes: <?= $story['like_count'] ?></p>
      <p><?= $story['description'] ?></p>
    </div>
  </div>
</li>
