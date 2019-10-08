<div class="panel panel-default">
    <form method="post">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-11">
                    <input class="form-control" name="nama" placeholder="Nama" value="<?php echo $this->input->post('nama') ?>">
                </div>
                <div class="col-sm-1">
                    <button name="cari" value="ok" class="btn btn-primary fa fa-search pull-right" title="Cari"></button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <small class="label label-info">Total data: <?php echo $dataCount ?></small>
                    <button class="btn btn-primary fa fa-list pull-right" name="view" value="list" title="view"></button>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php $this->load->view('template/pagination'); ?>
            <div class="row">
                <?php foreach ($data as $r) { ?>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h1 class="panel-title"><?php echo $r['name'] ?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img class="img-circle" width="100%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" alt="User Avatar">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="description-block">
                                            <span class="description-text">FOLLOWER</span>
                                            <h5 class="description-header"><?php echo rand(10, 5000) ?></h5>
                                        </div>
                                        <div class="description-block">
                                            <span class="description-text">POST</span>
                                            <h5 class="description-header"><?php echo rand(10, 10000) ?></h5>
                                        </div>
                                        <div class="description-block">
                                            <span class="description-text">PENGADUAN</span>
                                            <h5 class="description-header"><?php echo rand(10, 100) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer pull-right">
                                <button class="btn btn-primary fa fa-search" name="read" value="<?php echo $r['id'] ?>"></button>
                                <button class="btn btn-danger fa fa-trash"></button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
</div>