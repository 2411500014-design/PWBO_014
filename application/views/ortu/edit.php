<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Edit Data Ortu' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('ortu') ?>">Ortu</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Edit Data Ortu</h3>
            </div>
            <?= form_open('ortu/update/'.$ortu->id_ortu) ?>
            <div class="card-body">
              <?php if(validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="name_ibu">Nama Ibu <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name_ibu" name="name_ibu" value="<?= set_value('name_ibu', $ortu->name_ibu) ?>" required>
              </div>

              <div class="form-group">
                <label for="name_ayah">Nama Ayah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name_ayah" name="name_ayah" value="<?= set_value('name_ayah', $ortu->name_ayah) ?>" required>
              </div>

              <div class="form-group">
                <label for="hubungan">Hubungan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hubungan" name="hubungan" value="<?= set_value('hubungan', $ortu->hubungan) ?>" required>
              </div>

              <div class="form-group">
                <label for="telp">Telepon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telp" name="telp" value="<?= set_value('telp', $ortu->telp) ?>" required>
              </div>

              <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= set_value('alamat', $ortu->alamat) ?></textarea>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
              <a href="<?= base_url('ortu') ?>" class="btn btn-secondary">Batal</a>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



