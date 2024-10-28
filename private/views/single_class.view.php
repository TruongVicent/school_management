<?php

use App\core\controller;

$view = new controller();
$view->view('includes/header');
$view->view('includes/nav');
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= ASSETS ?>img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= ASSETS ?>img/favicon.png">
    <title>
        Home
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../<?= ASSETS ?>css/nucleo-icons.css" rel="stylesheet" />
    <link href="../<?= ASSETS ?>css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../<?= ASSETS ?>css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/../../<?= ASSETS ?>css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $view->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <?php if ($row): ?>
        <div class="row mt-5 pt-5">
            <div class="col-sm-9 col-md-9 bg-light p-2">
                <center>
                    <h5>
                        <?= esc($row->class) ?>
                    </h5>
                </center>
                <table class="table table-hover table-striped table table-bodered">
                    <tr>
                        <th>Class name: </th>
                        <td>
                            <?= $row->class ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Created by: </th>
                        <td>
                            <?= $row->user->firstname ?>
                            <?= $row->user->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Created: </th>
                        <td>
                            <?= get_date($row->date); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'lecturers' ? 'active' : ''; ?>" aria-current="page"
                        href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">Lecturers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'students' ? 'active' : ''; ?>"
                        href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?>"
                        href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Tests</a>
                </li>
            </ul>


            <?php
            switch ($page_tab) {
                case 'lecturers':
                    include (views_path('class_tab_lecturers'));
                    break;
                case 'students':
                    include (views_path('class_tab_students'));
                    break;
                case 'tests':
                    include (views_path('class_tab_tests'));
                    break;
                case 'lecturers-add':
                    include (views_path('class_tab_lecturers-add'));
                    break;
                case 'lecturers-remove':
                    include (views_path('class_tab_lecturers-remove'));
                    break;
                case 'students-add':
                    include (views_path('class_tab_students-add'));
                    break;
                case 'students-remove':
                    include (views_path('class_tab_students-remove'));
                    break;
                case 'tests-add':
                    include (views_path('class_tab_tests-add'));
                    break;
                default:
                    # code...
                    break;
            }

            ?>

        </div>
    <?php else: ?>
        <center>
            <h4>O no profile user not found.</h4>
        </center>
    <?php endif ?>
</div>

<?php
$view->view('includes/footer');
?>