<?php

use App\core\controller;

$view = new controller();
$view->view('includes/header');
$view->view('includes/nav');

?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $view->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>School</th>
                    <th>User id</th>
                    <th>Date</th>
                    <th><a href="<?= ROOT ?>/schools/add">
                            <button class="btn-sm btn-success bg-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="bi bi-plus"></i>Add School</button>
                        </a></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><button class="btn btn-primary"><i class="fa fa-chevron-right"></i></button></td>
                            <td>
                                <?= $row->school ?>
                            </td>
                            <td>
                                <?= $row->user->firstname ?>
                                <?= $row->user->lastname ?>
                            </td>
                            <td>
                                <?= get_date($row->date) ?>
                            </td>
                            <td class="d-flex gap-2 justify-content-between">
                                <a href="#" class="btn btn-sm btn-primary rounded-0">View</a>
                                <a href="<?= ROOT ?>/schools/edit/<?= $row->id ?>"
                                    class="btn btn-sm btn-outline-primary rounded-0"><i class="fa fa-edit"></i> Edit</a>
                                <a href="<?= ROOT ?>/schools/delete/<?= $row->id ?>"
                                    class="btn btn-sm btn-outline-danger rounded-0"><i class="fa fa-trash-alt"></i>Delete</a>
                                <a href="<?= ROOT ?>/switch_school/<?= $row->id ?>"
                                    class="btn btn-sm btn-outline-success rounded-0">Switch to<i
                                        class="bi bi-arrow-right"></i></a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <h4>No schools were found at this time</h4>
                <?php endif; ?>


            </tbody>
        </table>

    </div>
</div>


<?php
$view->view('includes/footer');
?>