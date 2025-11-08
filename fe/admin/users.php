<?php

use Libs\Database\DB;

$users = DB::table('users')->get();

?>

<?php loadFile('fe/partials/header') ?>
<div class="container-fluid">
    <!-- <div class="row mb-4">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1 d-flex justify-content-between">
                    <h1>Data Users</h1>

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="material-icons-outlined">add</i> Tambah</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col">
            <div class="bg-white pt-3 px-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="material-icons-outlined">add</i> Tambah</button>
            </div>
            <table id="datatable1" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $user['code'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['level'] ?></td>
                            <td>
                                <a href="javascript:void(0)" data-id="<?= $user['id'] ?>" data-bs-toggle="modal" data-bs-target="#editUserModal" class="btn btn-warning editBtn"><i class="material-icons-outlined">edit</i> Edit</a>
                                <a href="javascript:void(0)" data-id="<?= $user['id'] ?>" class="btn btn-danger deleteBtn"><i class="material-icons-outlined">delete</i> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="createForm">
                <div class="form-group mt-2">
                    <label class="mb-1" for="code">Kode</label>
                    <input type="text" class="form-control" name="code" id="code">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="level">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="supplier">Supplier</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createUser">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editForm">
                <input type="hidden" name="id" id="id">
                <div class="form-group mt-2">
                    <label class="mb-1" for="code">Kode</label>
                    <input type="text" class="form-control" name="code" id="code">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group mt-2">
                    <label class="mb-1" for="level">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="supplier">Supplier</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editUser">Submit</button>
            </div>
        </div>
    </div>
</div>
<?php loadFile('fe/partials/footer', implode(' ', [
    '<script src="assets/plugins/datatables/datatables.min.js"></script>',
    "<script>const dataTable = $('#datatable1').on('draw.dt', function (e, settings, json, xhr) {
        document.querySelector('#datatable1').parentNode.classList.add('table-responsive')
    }).DataTable();</script>",
    '<script src="assets/js/users.js"></script>',
])) ?>