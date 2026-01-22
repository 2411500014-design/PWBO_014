<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Tambah Data Pengukuran' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('pengukuran') ?>">Pengukuran</a></li>
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
              <h3 class="card-title">Form Tambah Data Pengukuran</h3>
            </div>
            <?= form_open('pengukuran/store') ?>
            <div class="card-body">
              <!-- Tampilkan error validasi -->
              <?php if(validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="kunjungan_id">Kunjungan <span class="text-danger">*</span></label>
                <select class="form-control" id="kunjungan_id" name="kunjungan_id" required>
                  <option value="">Pilih Kunjungan</option>
                  <?php foreach($kunjungan_list as $kunjungan): ?>
                    <option value="<?= $kunjungan->id_kunjungan ?>" <?= set_value('kunjungan_id') == $kunjungan->id_kunjungan ? 'selected' : '' ?>>
                      <?= $kunjungan->nama_anak ?> - <?= date('d/m/Y', strtotime($kunjungan->tgl_kunjungan)) ?> (<?= $kunjungan->fasilitas ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="tgl_ukur">Tanggal Ukur <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tgl_ukur" name="tgl_ukur" value="<?= set_value('tgl_ukur') ?>" required>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bb">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="bb" name="bb" value="<?= set_value('bb') ?>" placeholder="Contoh: 5.5" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tb">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="tb" name="tb" value="<?= set_value('tb') ?>" placeholder="Contoh: 60.5" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lk">Lingkar Kepala (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="lk" name="lk" value="<?= set_value('lk') ?>" placeholder="Contoh: 40.5" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="vaksin">Vaksin <span class="text-danger">*</span></label>
                <select class="form-control" id="vaksin" name="vaksin" required>
                  <option value="">Pilih Vaksin</option>
                  <option value="BCG" <?= set_value('vaksin') == 'BCG' ? 'selected' : '' ?>>BCG (Bacillus Calmette-Guérin)</option>
                  <option value="Hepatitis B" <?= set_value('vaksin') == 'Hepatitis B' ? 'selected' : '' ?>>Hepatitis B</option>
                  <option value="DPT" <?= set_value('vaksin') == 'DPT' ? 'selected' : '' ?>>DPT (Difteri, Pertusis, Tetanus)</option>
                  <option value="Hib" <?= set_value('vaksin') == 'Hib' ? 'selected' : '' ?>>Hib (Haemophilus influenzae type b)</option>
                  <option value="Polio" <?= set_value('vaksin') == 'Polio' ? 'selected' : '' ?>>Polio</option>
                  <option value="PCV" <?= set_value('vaksin') == 'PCV' ? 'selected' : '' ?>>PCV (Pneumococcal Conjugate Vaccine)</option>
                  <option value="Rotavirus" <?= set_value('vaksin') == 'Rotavirus' ? 'selected' : '' ?>>Rotavirus</option>
                  <option value="Campak" <?= set_value('vaksin') == 'Campak' ? 'selected' : '' ?>>Campak</option>
                  <option value="MMR" <?= set_value('vaksin') == 'MMR' ? 'selected' : '' ?>>MMR (Measles, Mumps, Rubella)</option>
                  <option value="DPT-HB-Hib" <?= set_value('vaksin') == 'DPT-HB-Hib' ? 'selected' : '' ?>>DPT-HB-Hib (Kombinasi)</option>
                  <option value="DPT-HB" <?= set_value('vaksin') == 'DPT-HB' ? 'selected' : '' ?>>DPT-HB (Kombinasi)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="status_gizi">Status Gizi <span class="text-danger">*</span></label>
                <select class="form-control" id="status_gizi" name="status_gizi" required>
                  <option value="">Pilih Status Gizi</option>
                  <option value="Gizi Baik" <?= set_value('status_gizi') == 'Gizi Baik' ? 'selected' : '' ?>>Gizi Baik</option>
                  <option value="Gizi Kurang" <?= set_value('status_gizi') == 'Gizi Kurang' ? 'selected' : '' ?>>Gizi Kurang</option>
                  <option value="Gizi Buruk" <?= set_value('status_gizi') == 'Gizi Buruk' ? 'selected' : '' ?>>Gizi Buruk</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
              <a href="<?= base_url('pengukuran') ?>" class="btn btn-secondary">
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

