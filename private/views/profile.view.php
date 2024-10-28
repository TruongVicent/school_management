<?php

use App\core\controller;

$view = new controller();
$view->view('includes/header');
$view->view('includes/nav');
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=ASSETS?>img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?=ASSETS?>img/favicon.png">
  <title>
  Home
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../<?=ASSETS?>css/nucleo-icons.css" rel="stylesheet" />
  <link href="../<?=ASSETS?>css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../<?=ASSETS?>css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../<?=ASSETS?>css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $view->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <?php if ($row): ?>
        <?php
        $image = get_image($row->image, $row->gender);
        ?>
        <div class="row mt-5 pt-5">
            <div class="col-sm-4 col-md-3">
                <img src="<?= $image ?>" width="150px" alt="" class="border border-primary d-block mx-auto rounded-circle">
                <h3 class="text-center">
                    <?= esc($row->firstname) ?>
                    <?= esc($row->lastname) ?>
                </h3>
            </div>
            <div class="col-sm-9 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table table-bodered">
                    <tr>
                        <th>First name: </th>
                        <td>
                            <?= $row->firstname ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Last name: </th>
                        <td>
                            <?= $row->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>
                            <!--<script>alert('hacker');</script> -->
                            <?= esc($row->email) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Gender: </th>
                        <td>
                            <?= $row->gender ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Last name: </th>
                        <td>
                            <?= ucwords(str_replace("_"," ","$row->rank")) ?>
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
                    <a class="nav-link active" aria-current="page" href="#">Basic info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tests</a>
                </li>
            </ul>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                    aria-describedby="addon-wrapping">
            </div>
        </div>
    <?php else: ?>
        <center>
            <h4>O no profile user not found.</h4>
        </center>
    <?php endif ?>
</div>

<!-- <?php
$view->view('includes/footer');
?> -->