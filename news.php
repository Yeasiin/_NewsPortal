<?php
require_once "include/header.php";
$page = "news";
require_once "include/navigation.php";

$pagination = $_GET["id"] ?? 0;

if($pagination == 0 || $pagination == 1){
    $pagination = 0;
}else{
    $pagination = ($pagination*4)-4;
}



$query = "SELECT * FROM news LIMIT {$pagination}, 4";
$result = mysqli_query($connection, $query);
$paginationQuery = mysqli_query($connection, "SELECT * FROM news");


?>

<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active "> News </li>
    </ul>
    <div class="d-flex justify-content-end mt-5 ">

        <a href="addNews.php" class="btn btn-primary">Add News</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Id </th>
                <th scope="col">Title </th>
                <th scope="col"> Description </th>
                <th scope="col">Date</th>
                <th scope="col"> Catagorie </th>
                <th scope="col"> Thumbnail </th>
                <th scope="col"> Action </th>

            </tr>
        </thead>
        <tbody>

            <?php if (mysqli_num_rows($result) < 1) {
            ?>
                <tr>
                    <td align="center" colspan="6">No News Found </td>
                </tr>

                <?php
            } else {
                $i = 0;
                while ($news = mysqli_fetch_assoc($result)) {
                    $i++;
                ?>
                    <tr>
                        <td scope="row"> <?php echo $i; ?> </td>
                        <td> <?php echo substr($news["newsTitle"], 0, 45); ?> </td>
                        <td> <?php echo substr($news["newsDescription"], 0, 130); ?> </td>
                        <td><?php echo
                            date("F j, Y <br> g:i A", strtotime($news["createdAt"]));
                            // $news["createdAt"]
                            ?></td>
                        <td><?php echo $news["newsCatagories"] ?></td>
                        <td align="center"> <img src="<?php echo $news["newsThumbnail"] ?>" alt="News Image" height=80> </td>
                        <td style="vertical-align:middle"><a class="btn btn-secondary" href="newsUpdate.php?id=<?php echo $news["id"] ?>">Update</a></td>

                    </tr>

            <?php
                }
            }
            ?>
            <ul class="pagination">
            <?php
                $totalPagination = ceil(mysqli_num_rows($paginationQuery) / 4);
                for ($i = 1; $i <= $totalPagination; $i++):
                ?>

                <li class="page-item"><a href="news.php?id=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
            <?php
                endfor;
            ?>


            </ul>
        </tbody>

    </table>


</div>




<?php require_once "include/footer.php"; ?>