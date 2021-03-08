<?php 
$session = $_SESSION["id"] ?? "";
if (!$session) {
  header("location:adminLogin.php");
} 
?>
<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 pl-15 mr-0" href="#"> Welcome-:
      <?php echo $_SESSION["name"] ?? ""; ?></a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" id="logout" href="destroy.php">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span data-feather="bar-chart-2"></span>
                Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $page == "news" ? "active" : "";  ?>" href="news.php">
                <span data-feather="file"></span>
                News
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $page == "catagories" ? "active" : "";  ?>" href="catagories.php">
                <span data-feather="shopping-cart"></span>
                Catagories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $page == "messages" ? "active" : "";  ?>" href="messages.php">
                <span data-feather="users"></span>
                Messages
              </a>
            </li>
          </ul>

        </div>
      </nav>