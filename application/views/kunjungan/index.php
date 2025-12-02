<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Data Kunjungan' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Kunjungan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $this->session->flashdata('error') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Kunjungan</h3>
              <div class="card-tools">
                <a href="<?= base_url('kunjungan/tambah') ?>" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> Tambah Data
                </a>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>NIK</th>
                    <th>Orang Tua</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Fasilitas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($kunjungan) && $kunjungan): $no = 1; foreach($kunjungan as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_anak ?></td>
                    <td><?= $row->nik ?></td>
                    <td><?= $row->name_ibu ?> / <?= $row->name_ayah ?></td>
                    <td><?= date('d/m/Y', strtotime($row->tgl_kunjungan)) ?></td>
                    <td><?= $row->fasilitas ?></td>
                    <td>
                      <a href="<?= base_url('kunjungan/edit/'.$row->id_kunjungan) ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <a href="<?= base_url('kunjungan/delete/'.$row->id_kunjungan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
