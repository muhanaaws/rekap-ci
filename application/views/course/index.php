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
        <a href="<?= base_url('dashboard') ?>" class="d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text">
          <img width="16px" src="<?= base_url('asset/icons/house-solid.svg') ?>" alt='' />
          <span class="ms-4">Dashboard</span>
        </a>
        <?php if ($role == 'mahasiswa'): ?>
          <a href="<?= base_url('enrollment') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
            <img width='16px' src="<?= base_url('asset/icons/school-solid.svg') ?>" alt='' />
            <span class='ms-4'>Kelas</span>
          </a>
        <?php else: ?>
          <a href="<?= base_url('kelas') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
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
        <span class="fs-2 p-0">KELAS</span>
      </div>
      <div class="row bg-secondary">
        <span class="fs-5 secondary-text">Semester - Genap <?= date('Y') ?>/<?= date('Y') + 1 ?></span>
      </div>

      <div class="row mt-3">
        <div class="col-10 mb-3">
          <span class="fs-5 p-0">List Kelas</span>
        </div>

        <div class='col-2'>
          <!-- START BUTTON ADD COURSE -->
          <div class='mb-2'>
            <button class='btn w-100 btn-secondary' data-bs-toggle='modal' data-bs-target='#add-course'>Tambah
              Kelas</button>
          </div>
          <!-- END BUTTON ADD COURSE -->

          <!-- START MODAL ADD COURSE -->
          <div class='modal fade' id='add-course' tabindex='-1' aria-labelledby='add-course-label' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h1 class='modal-title fs-5' id='add-course-label'>Tambah Kelas</h1>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='<?= base_url('course/insert'); ?>' method='POST' class='w-100'>
                  <div class='modal-body'>
                    <div class='w-100 mb-3'>
                      <label for='course_code' class='form-label'>Kode Mata Kuliah</label>
                      <input type='text' required class='form-control' id='course_code' name='course_code' placeholder='Kode Kelas' />
                    </div>
                    <div class='w-100 mb-3'>
                      <label for='course_name' class='form-label'>Nama Kelas</label>
                      <input type='text' required class='form-control' id='course_name' name='course_name' placeholder='Nama Kelas' />
                    </div>
                    <div class='w-100 mb-3'>
                      <label for='credit' class='form-label'>Jumlah SKS</label>
                      <input type='text' required class='form-control' id='credit' name='credit' placeholder='Jumlah SKS' />
                    </div>
                    <div class='w-100 mb-3'>
                      <label for='lecturer_id' class='form-label'>Pengampu</label>
                      <select class='form-select form-select-md' required id='lecturer_id' name='lecturer_id'
                        aria-label='Small select example'>
                        <option disabled selected>Pilih Pengampu</option>
                        <?php
                        foreach ($lecturers as $l):
                          $lecturer_id = $l['user_id'];
                          $lecturer_name = $l['name'];
                        ?>
                          <option value='<?= $lecturer_id; ?>'><?= $lecturer_name; ?></option>
                        <?php
                        endforeach;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    <button name='add-course' class='btn primary-btn' data-bs-dismiss='modal'>Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- END MODAL ADD COURSE -->
        </div>

        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope='col'>No</th>
              <th scope='col'>Kode</th>
              <th scope='col'>Mata Kuliah</th>
              <th scope='col'>Jumlah Sks</th>
              <th scope='col'>Jumlah Mahasiswa</th>
              <th scope='col'>Pengampu</th>
              <th scope='col'>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($courses as $c):
              $id = $c['course_id'];
              $course_code = $c['course_code'];
              $course_name = $c['course_name'];
              $credit = $c['credit'];
              $student_count = $c['student_count'];
              $lecturer = $c['lecturer_name'];
            ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $course_code; ?></td>
                <td><?= $course_name; ?></td>
                <td><?= $credit; ?></td>
                <td><?= $student_count; ?></td>
                <td><?= $lecturer; ?></td>
                <td>
                  <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-<?= $id; ?>">
                    <img width="15px" src="<?= base_url('asset/icons/edit.svg') ?>" alt="Edit">
                  </button>
                  <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delete-<?= $id; ?>">
                    <img width="15px" src="<?= base_url('asset/icons/delete.svg') ?>" alt="Delete">
                  </button>
                </td>
              </tr>

              <!-- START MODAL EDIT -->
              <div class='modal fade' id='edit-<?= $id; ?>' tabindex='-1' aria-labelledby='edit-label' aria-hidden='true'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h1 class='modal-title fs-5' id='edit-label'>Edit Kelas</h1>
                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <form action='<?= base_url('course/update/' . $id); ?>' method='POST' class='w-100'>
                      <div class='modal-body'>
                        <div class='w-100 mb-3'>
                          <label for='course_code' class='form-label'>Kode Mata Kuliah</label>
                          <input type='text' require class='form-control' id='course_code' name='course_code' placeholder='Kode Kelas' value="<?= $course_code; ?>" />
                        </div>
                        <div class='w-100 mb-3'>
                          <label for='course_name' class='form-label'>Nama Kelas</label>
                          <input type='text' require class='form-control' id='course_name' name='course_name' placeholder='Nama Kelas' value="<?= $course_name; ?>" />
                        </div>
                        <div class='w-100 mb-3'>
                          <label for='credit' class='form-label'>Jumlah SKS</label>
                          <input type='text' require class='form-control' id='credit' name='credit' placeholder='Jumlah SKS' value="<?= $credit; ?>" />
                        </div>
                        <div class='w-100 mb-3'>
                          <label for='lecturer_id' class='form-label'>Pengampu</label>
                          <select class='form-select form-select-md' require id='lecturer_id' name='lecturer_id'
                            aria-label='Small select example'>
                            <option disabled selected>Pilih Pengampu</option>
                            <?php
                            foreach ($lecturers as $l):
                              $lecturer_id = $l['user_id'];
                              $lecturer_name = $l['name'];
                            ?>
                              <?php if ($lecturer == $lecturer_name) : ?>
                                <option selected value='<?= $lecturer_id; ?>'><?= $lecturer_name; ?></option>
                              <?php else: ?>
                                <option value='<?= $lecturer_id; ?>'><?= $lecturer_name; ?></option>
                              <?php endif; ?>
                            <?php
                            endforeach;
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button name='add-course' class='btn primary-btn' data-bs-dismiss='modal'>Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- END MODAL EDIT -->

              <!-- START MODAL DElETE  -->
              <div class='modal fade' id='delete-<?= $id; ?>' tabindex='-1' aria-labelledby='delete-label' aria-hidden='true'>
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="delete-label">Delete Kelas</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span>Anda yakin untuk menghapus Kelas: <strong><?= $course_name; ?></strong>?</span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="<?= base_url('course/delete/' . $id) ?>">
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