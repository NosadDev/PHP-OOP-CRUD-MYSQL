<?php
require './template/header.php';
require './mysql.php';
$data = new Mysql();
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $result = $data->find($_GET['id']);
    $data->delete($_GET['id']);
    $_SESSION['action'] = "Delete PersonID:<b>" . $result['id'] . "</b> Successfully";
    $_SESSION['display'] = 1;
    return header('Location:./');
}
?>

<div class="col-md-3"></div>
<div class="col-md-6">
    <h4 class="text-center mb-3">PHP OOP CRUD MYSQL <a href="create.php" class="float-end btn btn-success">Create</a></h4>
    <?php
    if (isset($_SESSION['action'])) {
        echo '<div style="display:none"id="action"class="alert alert-success">' . $_SESSION['action'] . '</div>';
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $data->fetch();
            if ($result->num_rows() >= 1) {
                foreach ($result->get() as $key => $value) {
            ?>
                    <tr>
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['firstname'] ?></td>
                        <td><?= $value['lastname'] ?></td>
                        <td>
                            <a href="update.php?id=<?= $value['id'] ?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="?action=delete&id=<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="text-center text-info">not found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="col-md-3"></div>

<?php
require './template/footer.php';
?>