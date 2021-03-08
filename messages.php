<?php
require_once "include/header.php";
$page = "messages";
require_once "include/navigation.php";

 // Meta Title Set -- Hoisting
 function headerTitle(){
    return "Dashboard - Messages ";
  };

$pagination = $_GET["id"] ?? 0;
$paginationId = $_GET["id"] ?? 0;

if ($pagination == 0 || $pagination == 1) {
    $pagination = 0;
} else {
    $pagination = ($pagination * 7) - 7;
}


$query = "SELECT * FROM message ORDER BY receivedAt DESC LIMIT {$pagination}, 7";
$result = mysqli_query($connection, $query);
$paginationQuery = mysqli_query($connection, "SELECT * FROM message");


?>

<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active "> Messages </li>
    </ul>

    <?php $statusCode = $_GET["status"] ?? "";
    if ($statusCode) {
        echo getStatuscode($statusCode);
    }
    ?>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Id </th>
                <th scope="col">Name </th>
                <th scope="col"> Email </th>
                <th scope="col"> Messages </th>
                <th scope="col">Receive At</th>
                <th scope="col"> Action </th>

            </tr>
        </thead>
        <tbody>

            <?php if (mysqli_num_rows($result) < 1) {
            ?>
                <tr>
                    <td align="center" colspan="8">No Message Found </td>
                </tr>

                <?php
            } else {
                $i = 0;
                while ($message = mysqli_fetch_assoc($result)) {
                    $i++;
                ?>
                    <tr>
                        <td scope="row"> <?php echo $i; ?> </td>
                        <td> <?php echo $message["name"]; ?> </td>
                        <td> <?php echo$message["email"]; ?> </td>
                        
                        <td><?php echo $message["message"] ?></td>

                        <td><?php echo
                            date("F j, Y <br> g:i A", strtotime($message["receivedAt"]));
                            ?></td>
                        <td style="vertical-align:middle">
                        <form action="functions.php" method="POST" >
                            <input type="hidden" name="action" value="messageDelete" >
                            <input type="hidden" name="messageId" value="<?php echo $message["id"] ?>" >
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                        </td>

                    </tr>

            <?php
                }
            }
            ?>

        </tbody>

    </table>
    <ul class="pagination">
        <li class="page-item <?php echo $pagination > 1 ? "" : "disabled"; ?>"><a href="messages.php?id=<?php echo $paginationId - 1; ?>" class="page-link ">Previous</a></li>
        <?php
        $totalPagination = ceil(mysqli_num_rows($paginationQuery) / 4);
        for ($i = 1; $i <= $totalPagination; $i++) :
        ?>

            <li class="page-item"><a href="messages.php?id=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
        <?php
        endfor;
        ?>
        <li class="page-item <?php echo $paginationId < $totalPagination ? "" : "disabled"; ?> "><a href="messages.php?id=<?php echo $paginationId + 1; ?>" class="page-link">Next</a></li>

    </ul>

</div>



<?php require_once "include/footer.php"; ?>