<?php
//echo $this->db->last_query();
$number = 1 + (($pagination['page'] - 1) * $this->config->item('page_limit'));
//print_r($data);
//print_r($this->input->post());
?>
<form method="post">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php if (isset($filter)) { ?>
                <div class="row">
                    <?php foreach ($filter as $f) { ?>
                        <div class="col-sm-5">
                            <input class="form-control" name="<?php echo $f ?>" placeholder="<?php echo ucfirst($f) ?>" value="<?php echo $this->input->post($f) ?>">
                        </div>
                    <?php } ?>

                    <div class="col-sm-1">
                        <button name="cari" value="ok" class="btn btn-primary fa fa-search" title="Cari Data"></button>
                    </div>
                </div>
                <br/>
            <?php } ?>
            <div class="row">
                <div class="col-sm-2">
                    <small class="label label-info">Total data: <?php echo $dataCount ?></small>
                </div>
                <div class="col-sm-10">
                    <?php if (in_array('create', $crud)) { ?>
                        <a class="btn btn-primary fa fa-plus" href="<?php echo site_url($module . '/create'); ?>" title="Tambah Data"></a>
                    <?php } ?>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                </div>

            </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php foreach ($column as $c) { ?>
                            <th><?php echo ucfirst($c['title']) ?></th>
                        <?php } ?>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td><?php echo $number++ ?></td>
                            <?php foreach ($column as $c) { ?>
                                <td><?php echo $d[$c['title']] ?></td>
                            <?php } ?>
                            <td>
                                <?php if (in_array('read', $crud)) { ?>
                                <button name="read" value="<?php echo $d['id'] ?>" class="btn btn-primary fa fa-search" title="Lihat Detail"></button>
                                <?php } ?>
                                <?php if (in_array('update', $crud)) { ?>
                                <button name="edit" value="<?php echo $d['id'] ?>" class="btn btn-primary fa fa-edit" title="Edit Data"></button>
                                <?php } ?>
                                <?php if (in_array('delete', $crud)) { ?>                                    
                                <button name="initDelete" value="<?php echo $d['id'] ?>" class="btn btn-danger fa fa-trash" title="Hapus Data"></button>
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
    </div>
</form>
