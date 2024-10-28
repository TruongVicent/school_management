<h5>Remove</h5>
<form class="d-flex" method="POST" role="search" style="display: flex; align-items: center;">
<input value="<?= get_var('name') ?>" autofocus class="form-control me-2" type="search" name="name"
        placeholder="Search" aria-label="Search" style="height: 50px;">
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">
        <button class="btn btn-outline-warning mt-3" type="submit">cancel</button>
    </a>
    <button class="btn btn-outline-success mt-3" name="search" type="submit">Search</button>
</form>

<div class="container d-inline-flex">
    <form method="post" class="container d-inline-flex">
        <?php if (isset($results) && $results): ?>
            <?php foreach ($results as $row): ?>
                <?php include (views_path('user')) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php if (count($_POST) > 0): ?>
                <h4>No results</h4>
            <?php endif; ?>
        <?php endif; ?>
    </form>
</div>