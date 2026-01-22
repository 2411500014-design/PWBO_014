<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Edit Data Anak' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('anak') ?>">Anak</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
              <h3 class="card-title">Form Edit Data Anak</h3>
            </div>
            <?= form_open('anak/update/'.$anak->id_anak) ?>
            <div class="card-body">
              <?php if(validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="ortu_id">Orang Tua <span class="text-danger">*</span></label>
                <select class="form-control" id="ortu_id" name="ortu_id" required>
                  <option value="">Pilih Orang Tua</option>
                  <?php foreach($ortu_list as $ortu): ?>
                    <option value="<?= $ortu->id_ortu ?>" <?= ($anak->ortu_id == $ortu->id_ortu) ? 'selected' : '' ?>>
                      <?= $ortu->name_ibu ?> / <?= $ortu->name_ayah ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="name">Nama Anak <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', $anak->name) ?>" placeholder="Masukkan Nama Anak" required>
              </div>

              <div class="form-group">
                <label for="nik">NIK <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="nik" name="nik" value="<?= set_value('nik', $anak->nik) ?>" placeholder="Masukkan NIK" required>
              </div>

              <div class="form-group">
                <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" id="jk" name="jk" required>
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Laki-laki" <?= (set_value('jk', $anak->jk) == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Perempuan" <?= (set_value('jk', $anak->jk) == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir', $anak->tgl_lahir) ?>" required>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="bb_lahir">Berat Badan Lahir (kg) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="bb_lahir" name="bb_lahir" value="<?= set_value('bb_lahir', $anak->bb_lahir) ?>" placeholder="Contoh: 3.5" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tb_lahir">Tinggi Badan Lahir (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="tb_lahir" name="tb_lahir" value="<?= set_value('tb_lahir', $anak->tb_lahir) ?>" placeholder="Contoh: 50.5" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="goldar">Golongan Darah <span class="text-danger">*</span></label>
                <select class="form-control" id="goldar" name="goldar" required>
                  <option value="">Pilih Golongan Darah</option>
                  <option value="A" <?= (set_value('goldar', $anak->goldar) == 'A') ? 'selected' : '' ?>>A</option>
                  <option value="B" <?= (set_value('goldar', $anak->goldar) == 'B') ? 'selected' : '' ?>>B</option>
                  <option value="AB" <?= (set_value('goldar', $anak->goldar) == 'AB') ? 'selected' : '' ?>>AB</option>
                  <option value="O" <?= (set_value('goldar', $anak->goldar) == 'O') ? 'selected' : '' ?>>O</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
              </button>
              <a href="<?= base_url('anak') ?>" class="btn btn-secondary">
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




