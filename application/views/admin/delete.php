<div class="box box-danger">
    <div class="box-header bg-red">
        <h3>Anda yakin akan menghapus data ini?</h3>
    </div>
    <div class="box-body">
        <table class="table">
            <tbody>
                <tr>
                    <td>Username</td>
                    <td><?php echo $data['nama']?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td><?php echo $data['type']?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <form method="post">
            <a class="btn btn-primary" href="<?php echo site_url('admin') ?>">KEMBALI</a>
            <button class="btn btn-danger pull-right" name="delete" value="<?php echo $data['id']?>">HAPUS</button>
        </form>
    </div>
</div>
