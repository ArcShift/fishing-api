<?php
$i = 1+(($pagination['page']-1)*$this->config->item('page_limit'));
?>
<div class="panel panel-default">
    <form method="post">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-11">
                    <input class="form-control" name="nama" placeholder="Nama" value="<?php echo $this->input->post('nama')?>">
                </div>
                <div class="col-sm-1">
                    <button name="cari" value="ok" class="btn btn-primary fa fa-search pull-right" title="Cari"></button>
                </div>
            </div>
            <small class="label label-info">Total data: <?php echo $dataCount ?></small>
            <button class="btn btn-primary fa fa-th pull-right" name="view" value="thumnail"></button>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>E-Mail</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $r) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $r['name'] ?></td>
                            <td><?php echo $r['email'] ?></td>
                            <td>
                                <button class="btn btn-primary fa fa-search" name="read" value="<?php echo $r['id'] ?>"></button>
                                <button class="btn btn-danger fa fa-trash"></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php $this->load->view('template/pagination') ?>
        </div>
    </form>
</div>