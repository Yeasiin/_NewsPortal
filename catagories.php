<?php
require_once "include/header.php";
$page = "catagories";
require_once "include/navigation.php";

$query = "SELECT * FROM catagories";
$result = mysqli_query($connection, $query);
?>
<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active "> Catagories </li>
    </ul>
    <div class="d-flex justify-content-end mt-5 ">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#catagoriesmodal">
            Add Catagorie
        </button>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Id </th>
                <th scope="col"> Catagorie Name </th>
                <th scope="col"> Description </th>
                <th scope="col"> Action </th>
            </tr>
        </thead>
        <tbody>

            <?php if (mysqli_num_rows($result) < 1) {
            ?>
                <tr>
                    <td colspan="4">No Data Found </td>
                </tr>

                <?php
            } else {
                $i = 0;
                while ($catagories = mysqli_fetch_assoc($result)) {
                    $i++;
                ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo substr($catagories["catagories_name"], 0, 45); ?> </td>
                        <td> <?php echo substr($catagories["catagories_description"], 0, 130); ?> </td>
                        <td><a class="btn btn-secondary" href="CatagoriesUpdate.php?id=<?php echo $catagories["id"] ?>"> Update </a></td>
                    </tr>

            <?php
                }
            } ?>




        </tbody>

    </table>


</div>


<div class="modal fade" id="catagoriesmodal" tabindex="-1" aria-labelledby="catagoriesmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="catagoriesmodal">Add Catagories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="catagoriesForm" action="functions.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="catagoireName">Catagorie Name:</label>
                        <input type="text" name="catagoriesName" placeholder="Catagorie Name" class="form-control" id="catagoireName">
                    </div>
                    <div class="form-group">
                        <label for="catagorieDescription">Catagorie Description:</label>
                        <textarea class="form-control" name="catagorieDescription" placeholder="Description (Optional)" rows="5" id="catagorieDescription"></textarea>
                    </div>
                    <input type="hidden" name="action" value="addCatagorie">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add Catagorie" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "include/footer.php"; ?>