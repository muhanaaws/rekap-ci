<div class="container-fluid p-0" style="height: 100vh">
  <nav class="navbar border-bottom primary-bg w-100">
    <div class="w-100 d-flex align-items-center justify-content-between p-2">
      <a class="navbar-brand d-flex flex-row align-items-center" href="<?= base_url('dashboard'); ?>">
        <img width="64px" src="<?= base_url('asset/images/logo.png') ?>" alt="" />
        <span class="fs-1 secondary-text">Website</span>
      </a>
      <a href="<?= base_url('auth/logout'); ?>">
        <button type="submit" class="btn btn-light">
          <span>Logout</span>
          <img width=" 16px" src="<?= base_url('asset/icons/arrow-right-from-bracket-solid.svg') ?>" alt="" />
        </button>
      </a>
    </div>
  </nav>

  <div class="row h-100">
    <div class="col-2 primary-bg p-0">
      <div class="row d-flex flex-column align-items-center text-center p-2 my-4">
        <div class="w-50 text-center mb-4">
          <img class="img-fluid" src="<?= base_url('asset/icons/circle-user-regular.svg') ?>" alt="" />
        </div>
        <span class="secondary-text fs-3"><?= $name; ?></span>
        <span class="secondary-text"><?= $identity; ?></span>
      </div>

      <div class="row d-flex flex-column m-0 w-100 align-items-center py-2 ps-4">
        <a href="<?= base_url('dashboard') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
          <img width="16px" src="<?= base_url('asset/icons/house-solid.svg') ?>" alt='' />
          <span class="ms-4">Dashboard</span>
        </a>
        <?php if ($role == 'mahasiswa'): ?>
          <a href="<?= base_url('enrollment') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
            <img width='16px' src="<?= base_url('asset/icons/school-solid.svg') ?>" alt='' />
            <span class='ms-4'>Kelas</span>
          </a>
        <?php else: ?>
          <a href="<?= base_url('kelas') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
            <img width='16px' src="<?= base_url('asset/icons/school-solid.svg') ?>" alt='' />
            <span class='ms-4'>Kelas</span>
          </a>
        <?php endif; ?>
        <a href="<?= base_url('penilaian') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
          <img width='16px' src="<?= base_url('asset/icons/pen-to-square-solid.svg') ?>" alt='' />
          <span class='ms-4'>Penilaian</span>
        </a>
        <a href="<?= base_url('input_nilai') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
          <img width='16px' src="<?= base_url('asset/icons/circle-plus-solid.svg') ?>" alt='' />
          <span class='ms-4'>Input Nilai</span>
        </a>
        <a href="<?= base_url('rekap') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
          <img width='16px' src="<?= base_url('asset/icons/rotate-solid.svg') ?>" alt='' />
          <span class='ms-4'>Rekap</span>
        </a>
      </div>
    </div>

    <div class="col-10 p-5">
      <div class="row">
        <span class="fs-2 p-0">DASHBOARD <?= strtoupper($role) ?></span>
      </div>
      <div class="row bg-secondary">
        <span class="fs-5 secondary-text">Semester - Genap <?= date('Y') ?>/<?= date('Y') + 1 ?></span>
      </div>

      <div class="row mt-3">
        <div class="col-10 mb-3">
          <?php if ($role == 'admin'): ?>
            <span class="fs-5 p-0">List User</span>
          <?php elseif ($role == 'dosen'): ?>
            <span class="fs-5 p-0">List Mahasiswa</span>
          <?php elseif ($role == 'mahasiswa'): ?>
            <span class="fs-5 p-0">List Kelas</span>
          <?php endif; ?>
        </div>

        <div class="col-2">
          <?php if ($role == 'admin'): ?>
            <!-- START BUTTON ADD USER -->
            <div class="mb-3">
              <button class="btn w-100 btn-secondary" data-bs-toggle="modal" data-bs-target="#addUser">Tambah
                User</button>
            </div>
            <!-- END BUTTON ADD USER -->

            <!-- START MODAL ADD USER -->
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserLabel">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('user/insert'); ?>" method="POST" class="w-100">
                    <div class="modal-body">
                      <div class="w-100 mb-3">
                        <label for="identity" class="form-label">Identity</label>
                        <input type="text" class="form-control" id="identity" name="identity" placeholder="Identity" required />
                      </div>
                      <div class="w-100 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
                      </div>
                      <div class="w-100 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select form-select-md" id="role" name="role"
                          aria-label="Small select example" required>
                          <option disabled selected>Pilih Role</option>
                          <option value="admin">Admin</option>
                          <option value="dosen">Dosen</option>
                          <option value="mahasiswa">Mahasiswa</option>
                        </select>
                      </div>
                      <div class="w-100 mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button name="addUser" class="btn primary-btn" data-bs-dismiss="modal">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- END MODAL ADD USER -->
          <?php endif; ?>
        </div>

        <!-- START TABLE USER -->
        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nomor Identitas</th>
              <th scope="col">Nama</th>
              <th scope="col">Level</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($users as $u):
              $id = $u['user_id'];
              $id_number = $u['role_identity'];
              $name = $u['name'];
              $status = $u['status'];
              $level = $u['role'];
            ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $id_number; ?></td>
                <td><?= $name; ?></td>
                <td><?= $level; ?></td>
                <td><?= $status; ?></td>
                <td>
                  <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-<?= $id; ?>">
                    <img width="15px" src="<?= base_url('asset/icons/edit.svg') ?>" alt="Edit">
                  </button>
                  <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delete-<?= $id; ?>">
                    <img width="15px" src="<?= base_url('asset/icons/delete.svg') ?>" alt="Delete">
                  </button>
                </td>
              </tr>

              <!-- START MODAL EDIT  -->
              <div class='modal fade' id='edit-<?= $id; ?>' tabindex='-1' aria-labelledby='edit-label' aria-hidden='true'>
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="edit-label">Change User Status</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span>Anda yakin untuk mengubah status dari User: <strong><?= $name; ?></strong>?</span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="<?= base_url('user/change_status/' . $id) ?>">
                        <button type="submit" class="btn primary-btn">Confirm</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END MODAL EDIT -->

              <!-- START MODAL DElETE  -->
              <div class='modal fade' id='delete-<?= $id; ?>' tabindex='-1' aria-labelledby='delete-label' aria-hidden='true'>
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="delete-label">Delete User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span>Anda yakin untuk menghapus User: <strong><?= $name; ?></strong>?</span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="<?= base_url('user/delete/' . $id) ?>">
                        <button type="submit" class="btn primary-btn">Confirm</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END MODAL DELETE -->

            <?php
              $i++;
            endforeach;
            ?>


          </tbody>
        </table>
        <!-- END TABLE USER -->
      </div>
    </div>
  </div>
</div>