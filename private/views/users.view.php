<?php

use App\core\controller;

$view = new controller();
$view->view('includes/header');
$view->view('includes/nav');
?>


<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $view->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <form class="d-flex" role="search" style="display: flex; align-items: center;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                    style="height: 50px;">
                <button class="btn btn-outline-success mt-3" type="submit">Search</button>
            </form>
            <a class="float-end" href="<?= ROOT ?>/signup">
                <button class="btn-sm btn-success bg-success float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-plus"></i>Add School</button>
            </a>
        </div>
    </nav>


    <div class="row mt-5">
        <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
               <!-- include path -->
            <?php include(views_path('user')) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h4>not staff members</h4>
        <?php endif; ?>
    </div>

</div>


<?php
$view->view('includes/footer');
?>