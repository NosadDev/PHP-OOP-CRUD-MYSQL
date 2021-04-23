<?php
require './template/header.php';
if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
    require './mysql.php';
    $data = new Mysql();
    $query = $data->create($_POST['firstname'], $_POST['lastname']);
    if ($query === true) {
        $_SESSION['action'] = 'Create PersonID:<b>' . $data->createID() . '</b> Successfully';
        $_SESSION['display'] = 1;
        return header('Location:./');
    }
}
?>

<div class="col-md-3"></div>
<div class="col-md-6">
    <h4 class="text-center mb-3">Create<a href="index.php" class="float-end btn btn-secondary">Back</a></h4>
    <form action="" method="post">
        <div class="form-goup mb-2">
            <label for="firstname">firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="60" required>
        </div>
        <div class="form-goup mb-2">
            <label for="lastname">lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" maxlength="60" required>
        </div>
        <button class="btn btn-success">Create</button>
    </form>
</div>
<div class="col-md-3"></div>

<?php
require './template/footer.php';
?>