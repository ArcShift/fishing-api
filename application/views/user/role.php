<div class="box">
    <div class="box-body">
        <button class="btn btn-primary fa fa-plus" data-toggle="modal" data-target="#modalCreate"></button>
        <form method="post" id="mainForm">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data1 as $r) { ?>
                        <tr>
                            <td>-</td>
                            <td><?php echo $r['nama'] ?></td>
                            <td>
                                <input class="btn btn-primary fa fa-edit" type="submit" name="edit" value="<?php echo $r['id'] ?>"/>
                                <button class="btn btn-danger fa fa-trash" type="submit" name="hapus" value="<?php echo $r['id'] ?>"></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<!--MODAL CREATE-->
<div class="modal fade" id="modalCreate" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create User Role</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputNama" placeholder="Nama Role">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="create" value="ok">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#mainForm").on('submit', function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        console.log('submit');
    });
</script>