<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '
<div class="container media" style="margin-top: 50px;">
    <h1>Ask a Question : </h1>
    <div class="formQ  bg-light mt-2 mb-3 p-3">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
           <div class="form-group">
            <label for="exampleInputPassword1">Type your Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary my-2">Post Comment</button>
        </form>
    </div>';
} else {
    echo "<div class='alert alert-danger mt-4'>User is not Logged In. Please Login to Post a Comment...</div>";
}
