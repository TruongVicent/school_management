<?php
$image = get_image($row->image, $row->gender);
?>
<div class="col-4  mt-5">
    <div class="card mb-2 shadow-sm" style="max-width: 16rem; min-width: 16rem;">
        <img src="<?= $image ?>" width="50px" alt="" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">
                <?= $row->firstname ?>
                <?= $row->lastname ?>
            </h5>
            <p class="card-text">
                <?= str_replace("_", "", $row->rank) ?>
            </p>
            <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary">Profile</a>
            <?php if (isset($_GET['select'])): ?>
                <button name="selected" value="<?= $row->user_id ?>" class="btn float-end btn-warning">Select</button>
            <?php endif; ?>
        </div>
    </div>
</div>