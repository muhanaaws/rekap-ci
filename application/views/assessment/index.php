<div class="container-fluid p-0" style="height: 100vh">
  <nav class="navbar border-bottom primary-bg w-100">
    <div class="w-100 d-flex align-items-center justify-content-between p-2">
      <a class="navbar-brand d-flex flex-row align-items-center" href="dashboard.html">
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
        <a href="<?= base_url('kelas') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
          <img width='16px' src="<?= base_url('asset/icons/school-solid.svg') ?>" alt='' />
          <span class='ms-4'>Kelas</span>
        </a>
        <a href="<?= base_url('penilaian') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
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
        <span class="fs-2 p-0">PENILAIAN</span>
      </div>
      <div class="row bg-secondary">
        <span class="fs-5 secondary-text">Semester - Genap 2024/2025</span>
      </div>

      <div class="row mt-3">
        <div class="col-10 mb-3">
          <span class="fs-5 p-0">List Penilaian</span>
        </div>
        <div class='col-2'>

          <!-- START BUTTON ADD NILAI -->
          <div class='mb-2'>
            <button class='btn w-100 btn-secondary' data-bs-toggle='modal' data-bs-target='#add-penilaian'>Tambah
              Penilaian</button>
          </div>
          <!-- END BUTTON ADD NILAI -->

          <!-- START MODAL ADD NILAI -->
          <div class='modal fade' id='add-penilaian' tabindex='-1' aria-labelledby='add-penilaian-label' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h1 class='modal-title fs-5' id='add-penilaian-label'>Tambah Nilai</h1>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='<?= base_url('assessment/insert'); ?>' method='POST' class='w-100'>
                  <div class='modal-body'>
                    <div class='w-100 mb-3'>
                      <label for='course_id' class='form-label'>Mata Kuliah</label>
                      <select class='form-select form-select-md' required id='course_id' name='course_id'
                        aria-label='Small select example'>
                        <option disabled selected>Pilih Kelas</option>
                        <?php
                        foreach ($courses as $c):
                          $course_id = $c['course_id'];
                          $course_name = $c['course_name'];
                        ?>
                          <option value="<?= $course_id; ?>"><?= $course_name; ?></option>
                        <?php
                        endforeach;
                        ?>
                      </select>
                    </div>
                    <div class='w-100 mb-3'>
                      <label for='component_name' class='form-label'>Aspek Penilaian</label>
                      <input type='text' required class='form-control' id='component_name' name='component_name' placeholder='Aspek Penilaian' />
                    </div>
                    <div class='w-100 mb-3'>
                      <label for='component_weight' class='form-label'>Bobot '%'</label>
                      <input type='number' min='0' max='100' required class='form-control' id='component_weight' name='component_weight' placeholder='Bobot' />
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    <button name='add-assessment' class='btn primary-btn' data-bs-dismiss='modal'>Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- END MODAL ADD NILAI -->
        </div>

        <!-- START TABLE USER -->
        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope='col'>No</th>
              <th scope='col'>Kode</th>
              <th scope='col'>Mata Kuliah</th>
              <th scope='col'>Aspek Penilaian</th>
              <th scope='col'>Bobot</th>
              <th scope='col'>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($assessments as $a):
              $id = $a['component_id'];
              $course_code = $a['course_code'];
              $course = $a['course_name'];
              $component_name = $a['component_name'];
              $component_weight = $a['component_weight'];
            ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $course_code; ?></td>
                <td><?= $course; ?></td>
                <td><?= $component_name; ?></td>
                <td><?= $component_weight * 100; ?></td>
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
                      <h1 class='modal-title fs-5' id='edit-label'>Edit Penilaian</h1>
                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <form action='<?= base_url('assessment/update/' . $id); ?>' method='POST' class='w-100'>
                      <div class='modal-body'>
                        <div class='w-100 mb-3'>
                          <label for='course_id' class='form-label'>Mata Kuliah</label>
                          <select class='form-select form-select-md' require id='course_id' name='course_id'
                            aria-label='Small select example'>
                            <option disabled>Pilih Kelas</option>
                            <?php
                            foreach ($courses as $c):
                              $course_id = $c['course_id'];
                              $course_name = $c['course_name'];
                            ?>
                              <?php if ($course == $course_name): ?>
                                <option selected value="<?= $course_id; ?>"><?= $course_name; ?></option>
                              <?php else: ?>
                                <option value="<?= $course_id; ?>"><?= $course_name; ?></option>
                              <?php endif; ?>
                            <?php
                            endforeach;
                            ?>
                          </select>
                        </div>
                        <div class='w-100 mb-3'>
                          <label for='component_name' class='form-label'>Aspek Penilaian</label>
                          <input type='text' require class='form-control' id='component_name' name='component_name' placeholder='Aspek Penilaian' value='<?= $component_name; ?>' />
                        </div>
                        <div class='w-100 mb-3'>
                          <label for='component_weight' class='form-label'>Bobot %</label>
                          <input type='number' min='0' max='100' require class='form-control' id='component_weight' name='component_weight' placeholder='Bobot' value='<?= $component_weight * 100; ?>' />
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button name='edit-assessment' class='btn primary-btn' data-bs-dismiss='modal'>Save</button>
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
                      <h5 class="modal-title" id="delete-label">Delete Penilaian</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span>Anda yakin untuk menghapus Penilaian: <strong><?= $component_name; ?></strong>?</span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="<?= base_url('assessment/delete/' . $id) ?>">
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