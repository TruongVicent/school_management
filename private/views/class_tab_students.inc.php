<!-- <nav class="navbar bg-light">
    <div class="container-fluid">
        <form class="d-flex" role="search" style="display: flex; align-items: center;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                style="height: 50px;">
            <button class="btn btn-outline-success mt-3" type="submit">Search</button>
        </form>
        <a class="float-end" href="<?= ROOT ?>/signup">
            <button class="btn-sm btn-success bg-success float-end" data-bs-toggle="modal"
                data-bs-target="#exampleModal"><i class="bi bi-plus"></i>Add Students</button>
        </a>
    </div>
</nav> -->



<nav class="navbar bg-light">
    <div class="container-fluid">
        <form class="d-flex" role="search" style="display: flex; align-items: center;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                style="height: 50px;">
            <button class="btn btn-outline-success mt-3" type="submit">Search</button>
        </form>
        <div>
            <a class="float-end" href="<?= ROOT ?>/single_class/studentremove/<?= $row->class_id ?>?select=true">
                <button class="btn-sm btn-success bg-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-dash-lg"></i> Remove students</button>
            </a>
            <a class="float-end" href="<?= ROOT ?>/single_class/studentadd/<?= $row->class_id ?>?select=true">
                <button class="btn-sm btn-success bg-success float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-plus"></i>Add students</button>
            </a>
        </div>
    </div>
</nav>

<div class="row mt-5">
    <?php if (is_array($students)): ?>
        <?php foreach ($students as $student): ?>

            <?php
            $row = $student->user;
            include (views_path('user')); ?>

        <?php endforeach; ?>
    <?php else:?>
        <h4>No students were not fount</h4>
    <?php endif; ?>
</div>