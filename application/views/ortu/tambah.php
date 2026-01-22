<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Tambah Data Orang Tua' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('ortu') ?>">Orang Tua</a></li>
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
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Tambah Data Orang Tua</h3>
            </div>
            <?= form_open('ortu/store') ?>
            <div class="card-body">
              <!-- Tampilkan error validasi -->
              <?php if(validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <!-- Nama Ibu -->
              <div class="form-group">
                <label for="name_ibu">Nama Ibu <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name_ibu" name="name_ibu" 
                       value="<?= set_value('name_ibu') ?>" 
                       placeholder="Masukkan Nama Ibu" required>
              </div>

              <!-- Nama Ayah -->
              <div class="form-group">
                <label for="name_ayah">Nama Ayah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name_ayah" name="name_ayah" 
                       value="<?= set_value('name_ayah') ?>" 
                       placeholder="Masukkan Nama Ayah" required>
              </div>

              <!-- Hubungan -->
              <div class="form-group">
                <label for="hubungan">Hubungan <span class="text-danger">*</span></label>
                <select class="form-control" id="hubungan" name="hubungan" required>
                  <option value="">Pilih Hubungan</option>
                  <option value="Orang Tua Kandung" <?= set_value('hubungan') == 'Orang Tua Kandung' ? 'selected' : '' ?>>Orang Tua Kandung</option>
                  <option value="Orang Tua Tiri" <?= set_value('hubungan') == 'Orang Tua Tiri' ? 'selected' : '' ?>>Orang Tua Tiri</option>
                  <option value="Wali" <?= set_value('hubungan') == 'Wali' ? 'selected' : '' ?>>Wali</option>
                  <option value="Lainnya" <?= set_value('hubungan') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
              </div>

              <!-- Telepon -->
              <div class="form-group">
                <label for="telp">Telepon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telp" name="telp" 
                       value="<?= set_value('telp') ?>" 
                       placeholder="Contoh: 081234567890" required>
              </div>

              <!-- Alamat -->
              <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                          placeholder="Masukkan Alamat Lengkap" required><?= set_value('alamat') ?></textarea>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
              <a href="<?= base_url('ortu') ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
              </a>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
