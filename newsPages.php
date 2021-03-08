<?php
require_once("include/header.php");
require_once("include/blogNavigation.php");

// Meta Title Set -- Hoisting
function headerTitle()
{
  return "News Portal";
};
$sortBy = $_GET["sortBy"] ?? "";
$search = $_GET["search"] ?? "";
$pagination = $_GET["id"] ?? 0;
$paginationId = $_GET["id"] ?? 0;

if ($pagination == 0 || $pagination == 1) {
  $pagination = 0;
} else {
  $pagination = ($pagination * 4) - 4;
}
if ($sortBy) {
  $paginationQuery = mysqli_query($connection, "SELECT * FROM news WHERE (newsCatagories='{$sortBy}') ");
  $query = "SELECT * FROM news WHERE (newsCatagories='{$sortBy}') ORDER BY createdAt DESC LIMIT {$pagination}, 4 ";
} elseif ($search) {
  $paginationQuery = mysqli_query($connection, "SELECT * FROM news WHERE (newsTitle LIKE '%{$search}%')  ");
  $query = "SELECT * FROM news WHERE (newsTitle LIKE '%{$search}%')  ORDER BY createdAt DESC LIMIT {$pagination}, 4 ";
}

$result = mysqli_query($connection, $query);

?>




</div>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-3 mb-4 font-italic border-bottom">
        Sort By Catagories
      </h3>

      <?php


      while ($indexNews = mysqli_fetch_assoc($result)) {

      ?>

        <div class="blog-post">
          <h2 class="blog-post-title"><?php echo $indexNews["newsTitle"]; ?></h2>
          <p class="blog-post-meta"><?php echo date("F j, Y", strtotime($indexNews["createdAt"])); ?> by <a class="text-capitalize" href="#"><?php echo $indexNews["createdBy"] ?></a></p>
          <p><img src="<?php echo $indexNews["newsThumbnail"]; ?>" width="600" alt=""></p>
          <p>
            <?php
            echo substr($indexNews["newsDescription"], 0, 600);
            ?>
            ... <a href="singleNews.php?id=<?php echo $indexNews["id"] ?>">Read More</a>
          </p>
        </div><!-- /.blog-post -->

      <?php
      }
      ?>


      <?php if (mysqli_num_rows($paginationQuery) > 5) { ?>
        <ul class="pagination">
          <li class="page-item <?php echo $pagination > 1 ? "" : "disabled"; ?>"><a href="index.php?id=<?php echo $paginationId - 1; ?>" class="page-link ">Previous</a></li>
          <?php
          $totalPagination = ceil(mysqli_num_rows($paginationQuery) / 4);
          for ($i = 1; $i <= $totalPagination; $i++) :
          ?>

            <li class="page-item"><a href="newsPages.php?id=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
          <?php
          endfor;
          ?>
          <li class="page-item <?php echo $paginationId < $totalPagination ? "" : "disabled"; ?> "><a href="index.php?id=<?php echo $paginationId + 1; ?>" class="page-link btn btn-outline-primary">Next</a></li>

        </ul>
      <?php } ?>


    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>

      <div class="p-3">
        <h4 class="font-italic">Catagories</h4>
        <hr>
        <ol class="list-unstyled mb-0">
          <?php
          $query = "SELECT * FROM catagories";
          $result = mysqli_query($connection, $query);
          while ($catagorie = mysqli_fetch_assoc($result)) :
          ?>
            <li><a href="newsPages.php?sortBy=<?php echo $catagorie["catagories_name"] ?>"><?php echo $catagorie["catagories_name"] ?></a></li>
          <?php endwhile; ?>
        </ol>
      </div>

      <div class="p-3">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>


</body>

</html>