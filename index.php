<?php
require_once("include/header.php");
require_once("include/blogNavigation.php");

// Meta Title Set -- Hoisting
function headerTitle()
{
  return "News Portal";
};

$pagination = $_GET["id"] ?? 0;
$paginationId = $_GET["id"] ?? 0;

if ($pagination == 0 || $pagination == 1) {
  $pagination = 0;
} else {
  $pagination = ($pagination * 4) - 4;
}


?>


<div class="jumbotron p-3 p-md-5 text-white custom-image rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <strong class="d-inline-block mb-2 text-primary">World</strong>
        <h3 class="mb-0">
          <a class="text-dark" href="#">Featured post</a>
        </h3>
        <div class="mb-1 text-muted">Nov 12</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#">Continue reading</a>
      </div>
      <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
    </div>
  </div>
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <strong class="d-inline-block mb-2 text-success">Design</strong>
        <h3 class="mb-0">
          <a class="text-dark" href="#">Post title</a>
        </h3>
        <div class="mb-1 text-muted">Nov 11</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#">Continue reading</a>
      </div>
      <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
    </div>
  </div>
</div>
</div>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-3 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>

      <?php
      $paginationQuery = mysqli_query($connection, "SELECT * FROM news");
      $query = "SELECT * FROM news ORDER BY createdAt DESC LIMIT {$pagination}, 4 ";
      $result = mysqli_query($connection, $query);

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


        <ul class="pagination">
          <li class="page-item <?php echo $pagination > 1 ? "" : "disabled"; ?>"><a href="index.php?id=<?php echo $paginationId - 1; ?>" class="page-link ">Previous</a></li>
          <?php
          $totalPagination = ceil(mysqli_num_rows($paginationQuery) / 4);
          for ($i = 1; $i <= $totalPagination; $i++) :
          ?>

            <li class="page-item"><a href="index.php?id=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
          <?php
          endfor;
          ?>
          <li class="page-item <?php echo $paginationId < $totalPagination ? "" : "disabled"; ?> "><a href="index.php?id=<?php echo $paginationId + 1; ?>" class="page-link btn btn-outline-primary">Next</a></li>

        </ul>


    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>

      <div class="p-3">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">March 2014</a></li>
          <li><a href="#">February 2014</a></li>
          <li><a href="#">January 2014</a></li>
          <li><a href="#">December 2013</a></li>
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
          <li><a href="#">June 2013</a></li>
          <li><a href="#">May 2013</a></li>
          <li><a href="#">April 2013</a></li>
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