<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Tambah Data Kunjungan' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('kunjungan') ?>">Kunjungan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Tambah Data Kunjungan</h3>
            </div>
            <?= form_open('kunjungan/store') ?>
            <div class="card-body">
              <?php if(validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="anak_id">Nama Anak <span class="text-danger">*</span></label>
                <select class="form-control" id="anak_id" name="anak_id" required>
                  <option value="">Pilih Anak</option>
                  <?php foreach($anak_list as $anak): ?>
                    <option value="<?= $anak->id_anak ?>" <?= set_value('anak_id') == $anak->id_anak ? 'selected' : '' ?>>
                      <?= $anak->name ?> (NIK: <?= $anak->nik ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="tgl_kunjungan">Tanggal Kunjungan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" value="<?= set_value('tgl_kunjungan') ?>" required>
              </div>

              <div class="form-group">
                <label for="fasilitas">Fasilitas <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="fasilitas" name="fasilitas" value="<?= set_value('fasilitas') ?>" placeholder="Contoh: Puskesmas, Rumah Sakit, Klinik" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="<?= base_url('kunjungan') ?>" class="btn btn-secondary">Batal</a>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


