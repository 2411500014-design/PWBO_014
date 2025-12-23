<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Data Pengukuran' ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Pengukuran</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
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
              <h3 class="card-title">Daftar Pengukuran</h3>
              <div class="card-tools">
                <a href="<?= base_url('pengukuran/tambah') ?>" class="btn btn-primary btn-sm">
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
                    <th>Tanggal Ukur</th>
                    <th>Berat Badan (kg)</th>
                    <th>Tinggi Badan (cm)</th>
                    <th>Lingkar Kepala (cm)</th>
                    <th>Vaksin</th>
                    <th>Status Gizi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($pengukuran) && $pengukuran):
                    $no = 1;
                    foreach ($pengukuran as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_anak ?></td>
                        <td><?= $row->nik ?></td>
                        <td><?= date('d/m/Y', strtotime($row->tgl_ukur)) ?></td>
                        <td><?= $row->bb ?></td>
                        <td><?= $row->tb ?></td>
                        <td><?= $row->lk ?></td>
                        <td><?= $row->vaksin ?></td>
                        <td><span class="badge badge-info"><?= $row->status_gizi ?></span></td>
                        <td>
                          <a href="<?= base_url('pengukuran/edit/' . $row->id_ukur) ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <a href="<?= base_url('pengukuran/delete/' . $row->id_ukur) ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i> Hapus
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; else: ?>
                    <tr>
                      <td colspan="10" class="text-center">Tidak ada data</td>
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