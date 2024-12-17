<div class="modal-body">
  <form method="POST" action="<?=base_url('User/create'); ?>" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="">Nama Lengkap</label>
      <input type="text" name="nama_lengkap" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="">Foto</label>
      <input type="file" name="foto" class="form-control" required>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
</div>

<form method="POST" action="<?=base_url('User/update'); ?>" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $r->$id; ?>"> 
  <div class="form-group mb-3">
    <label for="">Username</label>
    <input type="text" name="username" class="form-control" value="<?= $r['username']?>">
  </div>
  <div class="form-group mb-3">
    <label for="">Password</label>
    <input type="password" name="password" class="form-control" value="<?= $r['password']?>">
  </div>
  <div class="form-group mb-3">
    <label for="">Nama Langkap</label>
    <input type="text" name="nama_langkap" class="form-control" value="<?= $r['nama_langkap']?>">
  </div>
  <div class="form-group mb-3">
    <label for="">Foto</label>
    <input type="file" name="foto" class="form-control" value="<?= $r['foto']?>">
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
</form>