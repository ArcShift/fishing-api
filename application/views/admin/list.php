<?php
 $number=1+(($pagination['page']-1)*$this->config->item('page_limit'));
?>
<div class="panel panel-default">
    <form method="post">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-1">
                    <a class="btn btn-primary fa fa-plus" href="<?php echo site_url('admin/create'); ?>" title="Tambah Data"></a>
                </div>
                <div class="col-sm-5">
                    <input class="form-control" name="username" placeholder="Username" value="<?php echo $this->input->post('username')?>">
                </div>
                <div class="col-sm-5">
                    <select class="form-control" name="role">
                        <option value="">-- Jenis User --</option>
                        <?php foreach ($roles as $r) { ?>
                        <option value="<?php echo $r['id']?>" <?php echo $this->input->post('role')==$r['id']?'selected':'' ?>><?php echo $r['nama']?></option>                            
                        <?php }?>
                    </select>
                </div>
                <div class="col-sm-1">
                    <button name="cari" value="ok" class="btn btn-primary fa fa-search" title="Cari"></button>
                </div>
            </div>
            <small class="label label-info">Total data: <?php echo $dataCount ?></small>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Jenis User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data1 as $r) { ?>
                        <tr>
                            <td><?php echo $number++?></td>
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
        <div class="panel-footer">
            <?php $this->load->view('template/pagination') ?>
        </div>
    </form>
</div>