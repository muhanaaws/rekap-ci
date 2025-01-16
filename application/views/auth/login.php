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
        <div class="w-25 text-center mb-4">
          <img class="img-fluid" src="<?= base_url('asset/images/logo.png') ?>" alt="">
        </div>
        <h4 class="mb-4">Login</h4>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger w-100" role="alert">
            <?= $this->session->flashdata('error') ?>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('msg')): ?>
          <div class="alert alert-success w-100" role="alert">
            <?= $this->session->flashdata('msg') ?>
          </div>
        <?php endif; ?>

        <form action="<?= base_url('auth'); ?>" method="POST" class="w-100">
          <div class="w-100 mb-4">
            <label for="identity" class="form-label">Identity</label>
            <input type="text" class="form-control" id="identity" name="identity" placeholder="Identity" value="<?= set_value('identity'); ?>" />
            <?= form_error('identity', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <div class="w-100 mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>" />
            <?= form_error('password', '<span class="text-danger ps-2">', '</span>'); ?>
          </div>
          <button type="submit" name="login" class="w-100 btn btn-secondary mb-4">Login</button>
        </form>
        <div class="w-100 d-flex justify-content-end">
          <span>don't have an account yet? <a href="<?= base_url('register') ?>" class="primary-text">Register</a></span>
        </div>
      </div>
    </div>
  </div>
</div>