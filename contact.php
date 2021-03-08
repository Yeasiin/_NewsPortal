<?php
require_once "include/header.php";
require_once "include/blogNavigation.php";

function headerTitle()
{
    return "Contact Us";
}

?>


<form action="functions.php" name="contact" method="POST">
    <div class="form-group">
        <label for="name">Your Full Name</label>
        <input type="text" name="fullName" class="form-control" id="name" placeholder="John Doe">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Example@mail.com">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" name="contactMessage" id="message" rows="3"></textarea>
    </div>
    <div class="form-group">
    <input type="hidden" name="action" value="messages" >
    <input type="submit" class=" btn btn-primary contactMessage" value="Send">
    </div>
</form>
<?php 
    $status = $_GET["status"] ?? "";
    if($status){
        echo getStatuscode($status);
    }
?>



<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<script>
    document.querySelector(".contactMessage").addEventListener("click", (e) => {
        const contactName = document.forms["contact"]["fullName"].value;
        const contactEmail = document.forms["contact"]["email"].value;
        const contactMessage = document.forms["contact"]["contactMessage"].value;

        if (contactName == "" || contactName.length < 4 ) {
            alert("Insert Your Full Name");
            e.preventDefault();
        } else if (contactEmail == "") {
            alert(" Insert Your Full Email Address");
            e.preventDefault();
        } else if (contactMessage == "") {
            alert("Message Field Can't Be Empty");
            e.preventDefault();
        } else if (contactMessage.length < 20) {
            alert("Message Is Too Short");
            e.preventDefault();
        }


    });
</script>
</body>

</html>