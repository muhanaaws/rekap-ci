<div class="vh-100 d-flex justify-content-center align-items-center primary-bg py-5">
  <div class="row w-100">
    <div class="col-lg-7 col-md-6 d-flex align-items-center">
      <div class="ms-5 secondary-text">
        <h1>Website</h1>
        <h6>Rekapitulasi Penilaian Mahasiswa</h6>
        <h6>Universitas Amikom Yogyakarta</h6>
      </div>
    </div>
    <div class="col-lg-5 col-md-6 rounded-3 px-5">
      <div class="d-flex flex-column align-items-center rounded-3 bg-light py-5 px-4">
        <div class="w-25 text-center mb-3">
          <img class="img-fluid" src="<?= base_url('asset/images/logo.png') ?>" alt="">
        </div>
        <h4 class="mb-3">Register</h4>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger w-100" role="alert">
            <?= $this->session->flashdata('error') ?>
          </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/register'); ?>" method="POST" class="w-100">
          <div class="w-100 mb-3">
            <label for="identity" class="form-label">Identity</label>
            <input type="text" class="form-control" id="identity" name="identity" placeholder="Identity" value="<?= set_value('identity') ?>" />
            <?= form_error('identity', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <div class="w-100 mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= set_value('name') ?>" />
            <?= form_error('name', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <div class="w-100 mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select form-select-md" id="role" name="role"
              aria-label="Small select example">
              <option disabled selected>Pilih Role</option>
              <option value="admin">Admin</option>
              <option value="dosen">Dosen</option>
              <option value="mahasiswa">Mahasiswa</option>
            </select>
            <?= form_error('role', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <div class="w-100 mb-3">
            <label for="pass" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>" />
            <?= form_error('password', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <button type="submit" name="register" class="w-100 btn btn-secondary mb-3">Register</button>
        </form>
        <div class="w-100 d-flex justify-content-end">
          <span>already have an account? <a href="<?= base_url('login') ?>" class="primary-text">Login</a></span>
        </div>
      </div>
    </div>
  </div>
</div>