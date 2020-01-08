<div class="content-wrapper">
    <section class="content-header">
        <h1>User Management</h1>
        <ol class="breadcrumb">
            <li>
                <a href="home">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">User Management</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
                    Add User
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped users-table dt-responsive">
                    <thead>
                        <tr>
                            <th class="user-id">#</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Picture</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Show Users -->
                        <?php
                        $users = ControllerUsers::ctrShowUsers();
                        ?>

                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= $user['user']; ?></td>
                                    <td>
                                        <?php if (!empty($user['photo'])) : ?>
                                            <img src="<?= $user['photo']; ?>" class="img-thumbnail" alt="img-thumbnail" alt="<?= $user['name']; ?>" width="40px">
                                        <?php else : ?>
                                            <img src="views/img/users/default/anonymous.png" class="img-thumbnail" alt="<?= $user['name']; ?>" width="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $user['profile']; ?></td>
                                    <td>
                                        <button class="btn btn-<?= $user['status'] ? 'success' : 'danger'; ?> btn-xs">

                                            <?= $user['status'] ? 'Active' : 'Inactive'; ?>
                                        </button>
                                    </td>
                                    <td> <?= $user['lastLogin']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--
==================
| Add User Modal
==================
-->
<div id="modalAddUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header add-user-modal">
                    <button class="close" type="button" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title">Add User</h4>
                </div><!-- / .modal-header -->
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="newName" placeholder="Insert name" required>
                            </div>
                        </div>
                        <!-- / form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="newUser" placeholder="Add user" required>
                            </div>
                        </div>
                        <!-- / form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input type="password" class="form-control input-lg" name="newPassword" placeholder="Add password" required>
                            </div>
                        </div>
                        <!-- / form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <select class="form-control input-lg" name="newProfile" id="">
                                    <option value="">Select Profile</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Special">Special</option>
                                    <option value="Salesman">Salesman</option>
                                </select>
                            </div>
                        </div>
                        <!-- / form-group -->
                        <div class="form-group">
                            <div class="panel">
                                Upload Picture
                            </div>
                            <input class="form-control newPicture" type="file" name="newPicture">
                            <p class="help-block">Max size 2mb</p>
                            <img src="views/img/users/default/anonymous.png" class="img-thumbnail pic-preview" width="100px" alt="">
                        </div>
                        <!-- / form-group -->
                    </div>
                </div><!-- / .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div><!-- / .modal-footer -->
                <?php
                $createUser = new ControllerUsers();
                $createUser->ctrCreateUser();
                ?>
            </form>
        </div><!-- / .modal-content -->
    </div>
</div><!-- </Add User Modal> -->
