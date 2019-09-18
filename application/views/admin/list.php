<div class="box">
    <form method="post">
        <div class="box-header">
            <div class="row">
                <div class="col-sm-1">
                    <a class="btn btn-primary fa fa-plus" href="<?php echo site_url('admin/create'); ?>"></a>
                </div>
                <div class="col-sm-5">
                    <input class="form-control" name="username" placeholder="Username">
                </div>
                <div class="col-sm-5">
                    <select class="form-control" name="role">
                        <option value="">-- Role --</option>
                        <?php foreach ($roles as $r) { ?>
                        <option value="<?php echo $r['id']?>"><?php echo $r['nama']?></option>                            
                        <?php }?>
                    </select>
                </div>
                <div class="col-sm-1">
                    <button name="cari" value="ok" class="btn btn-primary fa fa-search"></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>User Type</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data1 as $r) { ?>
                        <tr>
                            <td></td>
                            <td><?php echo $r['nama'] ?></td>
                            <td><?php echo $r['type'] ?></td>
                            <td>
                                <?php if ($r['id'] === $this->session->userdata('userId')) { ?>
                                    <a class="btn btn-primary fa fa-edit" href="<?php echo site_url('admin/profile') ?>"></a>
                                <?php } else { ?>
                                    <button name="initDelete" value="<?php echo $r['id'] ?>" class="btn btn-danger fa fa-trash"></button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
</div>