<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>mahasiswacurl/tambah" class="btn btn-primary">Tambah
                Data Mahasiswa</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari data mahasiswa.." name="nama">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Daftar Mahasiswa</h3>
            <?php if ($mahasiswa == null) : ?>
                <div class="alert alert-danger" role="alert">
                    data mahasiswa tidak ditemukan.
                </div>
            <?php endif; ?>
            <ul class="list-group">
                <?php foreach ($mahasiswa as $mhs) : ?>
                    <li class="list-group-item">
                        <?= $mhs['nama']; ?>
                        <a href="<?= base_url(); ?>mahasiswacurl/hapus/<?= $mhs['id']; ?>" class="badge badge-danger float-right tombol-hapus">hapus</a>
                        <a href="<?= base_url(); ?>mahasiswacurl/ubah/<?= $mhs['id']; ?>" class="badge badge-success float-right">ubah</a>
                        <a href="<?= base_url(); ?>mahasiswacurl/detail/<?= $mhs['id']; ?>" class="badge badge-primary float-right">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>