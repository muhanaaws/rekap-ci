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
        <a href="<?= base_url('kelas') ?>" class='d-flex w-100 align-items-center text-center tertiary-bg secondary-text mb-2 link-dark py-2'>
          <img width='16px' src="<?= base_url('asset/icons/school-solid.svg') ?>" alt='' />
          <span class='ms-4'>Kelas</span>
        </a>
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
          <span class="fs-5 p-0">List Kelas Diampu</span>
        </div>

        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope='col'>No</th>
              <th scope='col'>Kode</th>
              <th scope='col'>Mata Kuliah</th>
              <th scope='col'>Jumlah Sks</th>
              <!-- <th scope='col'>Jumlah Mahasiswa</th> -->
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
            ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $course_code; ?></td>
                <td><?= $course_name; ?></td>
                <td><?= $credit; ?></td>
              </tr>

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