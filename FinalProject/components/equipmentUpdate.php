<?php
require_once './inc/functions.php';

$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);
    $price = InputProcessor::processString($_POST['price']);

    $valid = $name['valid'] && $description['valid'] && $image['valid']; 

    $message = !$valid ? "Please fix the above errors:" : '';

    if ($valid) {
        $args = [
            'name' => $name['value'],
            'description' => $description['value'],
            'image' => $image['value'],
            'id' => $_POST['id'],
            'price' => $_POST['price']
        ];

        $controllers->equipment()->update_equipment($args);

        redirect('adminInventory');
    }
}

$equipment = $controllers->equipment()->get_equipment_by_id($_GET['id']);
?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <section class="vh-100">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-2">Update Equipment</h3>
                            <div class="form-outline mb-4">
                                <input required type="text" id="name" name="name" class="form-control form-control-lg"
                                    placeholder="Name" value="<?= htmlspecialchars($equipment['name'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
                            </div>

                            <div class="form-outline mb-4">
                                <textarea required id="description" name="description"
                                    class="form-control form-control-lg" placeholder="Description"
                                    rows="4"><?= htmlspecialchars($equipment['description'] ?? '') ?></textarea>
                                <small class="text-danger"><?= htmlspecialchars($description['error'] ?? '') ?></small>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="text" id="image" name="image" class="form-control form-control-lg"
                                    placeholder="Image" value="<?= htmlspecialchars($equipment['image'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($image['error'] ?? '') ?></small>
                            </div>
                            <div class="form-outline mb-4">
                                <input required type="float" id="price" name="price"
                                    class="form-control form-control-lg" placeholder="price"
                                    value="<?= htmlspecialchars($image['value'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($image['error'] ?? '') ?></small>
                            </div>

                            <input type="hidden" id="id" name="id" value="<?= $equipment['id'] ?>" />

                            <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>

                            <?php if ($message): ?>
                            <div class="alert alert-danger mt-4">
                                <?= $message ?? '' ?>
                            </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>