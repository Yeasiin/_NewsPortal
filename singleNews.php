<?php
require_once "include/header.php";
require_once "include/blogNavigation.php";

$blogId = $_GET["id"] ?? "";

function headerTitle(){
    return "News";
  };

$query = "SELECT * FROM news WHERE id=\"{$blogId}\" ";
$result = mysqli_query($connection, $query);
$indexNews = mysqli_fetch_assoc($result);

?>

<div class="blog-post">
          <h2 class="blog-post-title"><?php echo $indexNews["newsTitle"]; ?></h2>
          <p class="blog-post-meta"><?php echo date("F j, Y", strtotime($indexNews["createdAt"])); ?> by <a class="text-capitalize" href="#"><?php echo $indexNews["createdBy"] ?></a></p>
          <p><img src="<?php echo $indexNews["newsThumbnail"]; ?>" width="100%" alt=""></p>
          <p>
            <?php
            echo $indexNews["newsDescription"];
            ?>

          </p>
        </div><!-- /.blog-post -->



  </div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#" >Back to top</a>
  </p>
</footer>


</body>

</html>
