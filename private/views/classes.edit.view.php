<?php
use App\core\controller;

$view = new controller();
$view->view('includes/header');
$view->view('includes/nav')
    ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= ASSETS ?>img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= ASSETS ?>img/favicon.png">
    <title>
        Home
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../<?= ASSETS ?>css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../<?= ASSETS ?>css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../<?= ASSETS ?>css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../../<?= ASSETS ?>css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>


<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $view->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <div class="row">
        <?php
        if ($row): ?>
            <form method="POST">
                <!-- error message -->
                <?php if (count($errors) > 0): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Lỗi:</strong>
                        <?php foreach ($errors as $error): ?>
                            <br>
                            <?= $error ?>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Name class:</label>
                    <input type="text" value="<?= get_var('class', $row[0]->class); ?>" value="class" name="class"
                        class="form-control" id="recipient-name">
                </div>
                <div class="modal-footer ml-3">
                    <a href="<?= ROOT ?>/classes">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    </a>
                    <button type="submit" value="save" class="btn btn-success">Save</button>
                </div>
            </form>
        <?php else: ?>
            <h3>That class was not found</h3>
            <a href="<?= ROOT ?>/classs">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </a>
        <?php endif; ?>
    </div>
</div>


<?php
$view->view('includes/footer');
?>