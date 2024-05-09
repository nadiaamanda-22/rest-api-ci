<div class="container">

    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Ubah Data Mahasiswa
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
                        <div class="form-group">
                            <label for="nama_anggota">Nama Anggota</label>
                            <input type="text" name="nama_anggota" class="form-control" id="nama_anggota" value="<?= $mahasiswa['nama_anggota']; ?>">
                            <small class="form-text text-danger"><?= form_error('nama_anggota'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="no_anggota">No Anggota</label>
                            <input type="text" name="no_anggota" class="form-control" id="no_anggota" maxlength="5" value="<?= $mahasiswa['no_anggota']; ?>">
                            <small class="form-text text-danger"><?= form_error('no_anggota'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?= $mahasiswa['jabatan']; ?>">
                            <small class="form-text text-danger"><?= form_error('jabatan'); ?></small>
                        </div>
                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                    </form>
                </div>
            </div>


        </div>
    </div>

</div>