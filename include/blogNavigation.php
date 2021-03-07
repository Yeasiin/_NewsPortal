<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#">Subscribe</a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">News Portal</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <form action="newsPages.php" method="post">
          <div class="input-group">
            <input type="search" value="" class="form-control rounded" placeholder="Search" aria-label="Search" name="search"  aria-describedby="search-addon" />
            <input type="submit" class="btn btn-outline-primary" value="Search" >
          </div>
          </form>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="index.php">Home</a>
        <?php
        $query = "SELECT catagories_name FROM catagories ORDER BY id LIMIT 6 ";
        $catagoreisNews = mysqli_query($connection, $query);

        while ($catagorie = mysqli_fetch_assoc($catagoreisNews)) {

        ?>
          <a class="p-2 text-muted" href="newsPages.php?sortBy=<?php echo $catagorie["catagories_name"] ?>"><?php echo $catagorie["catagories_name"] ?></a>
        <?php
        };
        ?>

      </nav>
    </div>