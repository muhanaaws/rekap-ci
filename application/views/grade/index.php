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
        <?php if ($role == 'admin' || $role == 'dosen'): ?>
          <a href="<?= base_url('penilaian') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
            <img width='16px' src="<?= base_url('asset/icons/pen-to-square-solid.svg') ?>" alt='' />
            <span class='ms-4'>Penilaian</span>
          </a>
          <a href="<?= base_url('input_nilai') ?>" class='d-flex w-100 align-items-center text-center mb-2 link-secondary secondary-text'>
            <img width='16px' src="<?= base_url('asset/icons/circle-plus-solid.svg') ?>" alt='' />
            <span class='ms-4'>Input Nilai</span>
          </a>
        <?php endif; ?>
        <a href="<?= base_url('rekap') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
          <img width='16px' src="<?= base_url('asset/icons/rotate-solid.svg') ?>" alt='' />
          <span class='ms-4'>Rekap</span>
        </a>
      </div>
    </div>

    <div class="col-10 p-5">
      <div class="row">
        <span class="fs-2 p-0">REKAPITULASI NILAI</span>
      </div>
      <div class="row bg-secondary">
        <span class="fs-5 secondary-text">Semester - Genap 2024/2025</span>
      </div>

      <div class="row mt-3">
        <div class="col mb-3">
          <span class="fs-5 p-0">REKAP NILAI</span>
        </div>
        <div class='col mb-2 d-flex align-center'>
          <form class='d-flex w-100' action='<?= base_url('grade/select_course'); ?>' method='POST' role='search'>
            <select class='form-select form-select-md me-1' id='course_id' name='course_id' aria-label='Small select example'>
              <option disabled selected>Pilih Kelas</option>

              <?php foreach ($courses as $c): ?>
                <option value="<?= $c['course_id']; ?>"
                  <?= (isset($selected_course) && $selected_course == $c['course_id']) ? 'selected' : '';  ?>>
                  <?= "$c[course_code] - $c[course_name]"; ?>
                </option>
              <?php endforeach; ?>

            </select>
            <button name='find-final' class='btn w-25 btn-secondary'>TAMPILKAN</button>
          </form>
        </div>

        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope="col">NIM</th>
              <th scope="col">Nama</th>
              <?php foreach ($course_components as $c): ?>
                <th scope="col"><?= $c['component_name']; ?></th>
              <?php endforeach; ?>

              <?php if ($role == 'admin' || $role == 'dosen'): ?>
                <th scope='col'>
                  <a class='btn btn-secondary btn-sm' href='<?= base_url('grade/calculate'); ?>'>Kalkulasi</a>
                </th>
              <?php endif; ?>

            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($students as $s):
            ?>
              <tr>
                <td><?= $s['role_identity'] ?></td>
                <td><?= $s['name'] ?></td>
                <?php
                foreach ($course_components as $c):
                  $component_name = $c['component_name'];
                ?>
                  <td><?= $s[$component_name] ?></td>
                <?php
                endforeach;
                ?>

                <?php if ($role == 'admin' || $role == 'dosen'): ?>
                  <td>
                    <form method="POST" action="<?= base_url('grade/edit') ?>">
                      <input type="hidden" name="student_data" value='<?= json_encode($s); ?>'>
                      <button class="btn btn-secondary btn-sm" type="submit">
                        <img width="15px" src="<?= base_url('asset/icons/edit.svg') ?>" alt="Edit">
                      </button>
                    </form>
                  </td>
                <?php endif; ?>
              </tr>
            <?php
            endforeach;
            ?>

          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>