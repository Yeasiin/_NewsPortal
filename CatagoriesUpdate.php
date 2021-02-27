<?php
require_once "include/header.php";
$page = "catagories";
require_once "include/navigation.php";

$id = $_GET["id"] ?? "";
if($id){

    $query = "SELECT * FROM catagories WHERE id='{$id}'";
    $result = mysqli_query($connection,$query);
    $catagories = mysqli_fetch_assoc($result);


};

?>
<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item "><a href="catagories.php"> Catagories</a></li>
        <li class="breadcrumb-item active" > Update Catagories </li>
    </ul>
<form name="catagoriesForm" action="functions.php" method="post">
<h2>Update Catagories</h2>
<hr>
    <div class="form-group">
        <label for="catagoireName">Catagorie Name:</label>
        <input type="text" name="catagoriesName" value="<?php echo $catagories["catagories_name"]; ?>" placeholder="Catagorie Name" class="form-control" id="catagoireName">
    </div>
    <div class="form-group">
        <label for="catagorieDescription">Catagorie Description:</label>
        <textarea class="form-control" name="catagorieDescription" placeholder="Description (Optional)" rows="5" id="catagorieDescription"><?php echo $catagories["catagories_description"]; ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?php echo $catagories["id"]; ?>" >
    <input type="hidden" name="catagoriesUpdate" value="true" >
    <input type="submit" name="action" value="Update" class="btn btn-primary">
    <input type="submit" name="action" value="Delete" class="btn btn-danger">
</form>
</div>

<?php require_once "include/footer.php"; ?>