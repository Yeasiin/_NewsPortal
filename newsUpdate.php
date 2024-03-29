<?php
require_once "include/header.php";
$page = "news";
require_once "include/navigation.php";

 // Meta Title Set -- Hoisting
 function headerTitle(){
    return "Update News ";
  };

$id = $_GET["id"] ?? "";

$query = "SELECT * FROM news WHERE id=\"{$id}\" ";
$result = mysqli_query($connection,$query);
$news = mysqli_fetch_assoc($result);
?>
<div class="col-md-10">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="news.php">News</a></li>
        <li class="breadcrumb-item active">Update News </li>
    </ul>
    <form name="newsForm" enctype="multipart/form-data" action="functions.php" method="post">
        <h2>Update News</h2>
        <hr>
        <div class="form-group">

            <?php $statusCode = $_GET["status"] ?? "";
            if ($statusCode) {
                echo getStatuscode($statusCode);
            }
            ?>

            <label for="newsTitle">News Title:</label>
            <input type="text" name="newsTitle" placeholder="Title..." class="form-control" value="<?php echo $news["newsTitle"];?>" id="newsTitle">
        </div>
        <div class="form-group">
            <label for="newsDescription">News Body:</label>
            <textarea class="form-control" name="newsDescription"  placeholder="News Body..." rows="5" id="newsDescription"><?php echo $news["newsDescription"];?></textarea>
            <input type="hidden" name="id" value="<?php echo $news["id"]?>" >
        </div>
        <!-- <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label for="formFile" class="form-label">Upload Image</label>
                    <input class="form-control" name="newsImage" type="file" id="formFile">
                </div>
                <div class="col-6">
                    <label for="formSelect" class="form-label">Select Catagories</label>
                    <select id="formSelect" name="newsCatagories" class="form-select form-select-md" aria-label=".form-select-sm ">
                        <option value=""> Select Catagories </option>
                        <?php
                        $newsCatagories = "SELECT * FROM catagories";
                        $newsCatagoriesQuery = mysqli_query($connection, $newsCatagories);
                        while ($newsCatagoriesResult = mysqli_fetch_assoc($newsCatagoriesQuery)) :
                        ?>
                            <option value="<?php echo "{$newsCatagoriesResult["catagories_name"]}" ?>"><?php echo "{$newsCatagoriesResult["catagories_name"]}" ?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>

            </div> 
        </div> -->

        <input type="submit" name="action" value="Update" class="btn btn-primary newsSubmit ">
        <input type="hidden" name="updateAction" value="newsUpdate" >
        <input type="submit" name="action" value="Delete" class="btn btn-danger newsSubmit ">
    </form>
</div>


<script>
    document.querySelector(".newsSubmit").addEventListener("click", function(e) {
        const newsTitle = document.forms["newsForm"]["newsTitle"].value;
        const newsDescription = document.forms["newsForm"]["newsDescription"].value;
        const newsCatagories = document.forms["newsForm"]["newsCatagories"].value;
        const newsImage = document.forms["newsForm"]["newsImage"].value;

        if (newsTitle == "") {
            alert("News Title Can't Be Empty ");
            e.preventDefault();
        } else if (newsDescription == "") {
            alert("News Description Can't Be Empty ");
            e.preventDefault();

        } else if (newsImage == "") {
            alert("Select An Image");
            e.preventDefault();
        } else if (newsCatagories == "") {
            alert("Select News Catagories");
            e.preventDefault();

        };

    });
</script>

<?php require_once "include/footer.php"; ?>