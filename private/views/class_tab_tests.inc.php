<nav class="navbar bg-light">
    <div class="container-fluid">
        <form class="d-flex" role="search" style="display: flex; align-items: center;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                style="height: 50px;">
            <button class="btn btn-outline-success mt-3" type="submit">Search</button>
        </form>
        <a class="float-end" href="<?= ROOT ?>/signup">
            <button class="btn-sm btn-success bg-success float-end" data-bs-toggle="modal"
                data-bs-target="#exampleModal"><i class="bi bi-plus"></i>Add Tests</button>
        </a>
    </div>
</nav>