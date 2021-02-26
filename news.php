<?php
require_once "include/header.php";
$page = "news";
require_once "include/navigation.php";



?>
<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">News </li>
    </ul>
    <form name="catagoriesForm" action="functions.php" method="post">
        <h2 class="modal-title" id="catagoriesmodal">Add News</h2>
        <hr>
        <div class="form-group">
            <label for="newsTitle">News Title:</label>
            <input type="text" name="newsTitle" placeholder="Title..." class="form-control" id="newsTitle">
        </div>
        <div class="form-group">
            <label for="newsDescription">News Body:</label>
            <textarea class="form-control" name="newsDescription" placeholder="News Body..." rows="5" id="newsDescription"></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label for="formFile" class="form-label">Upload Image</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="col-6">
                    <label for="formSelect" class="form-label">Select Catagories</label>
                    <select id="formSelect" class="form-select form-select-md" aria-label=".form-select-sm ">
                    <?php 
                        $query = "SELECT * FROM catagories";
                        $result = mysqli_query($connection, $query);
                        while($selectData = mysqli_fetch_assoc($result)):
                    ?>
                        <option value="<?php echo "{$selectData["id"]}" ?>"><?php echo "{$selectData["catagories_name"]}" ?></option>
                    <?php
                    endwhile; 
                    ?>
                    </select>
                </div>

            </div>
        </div>

        <input type="hidden" name="action" value="addNews">
        <input type="submit" value="Add News" class="btn btn-primary">
    </form>
</div>

<?php require_once "include/footer.php"; ?>