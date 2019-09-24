<div class="box">
    <form method="post">
        <div class="box-header">
            <button class="btn btn-primary fa fa-list pull-right" name="view" value="list"></button>
            <small class="label label-default">Total data: <?php echo $dataCount ?></small>
            <br/>
            <br/>
            <div>
                <?php $this->load->view('addon/pagination'); ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($data as $r) { ?>
                    <div class="col-sm-4">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-image">
                                <img class="img-circle" src="https://lh3.googleusercontent.com/-XR87VhPkuBQ/WF5aPmPtsVI/AAAAAAAABpg/52W88q-2Zpo/s300-c/cute-girl-20.jpg" alt="User Avatar">
                            </div>
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="background: url('https://kodi.wiki/images/thumb/3/39/Kodi-Wallpaper-2-Xmas-1080p_samfisher.jpg/300px-Kodi-Wallpaper-2-Xmas-1080p_samfisher.jpg') center center;">
                                <h3 class="widget-user-username"><?php echo $r['name'] ?></h3>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-3 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo rand(10, 5000) ?></h5>
                                            <span class="description-text">FOLLOWER</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-2 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo rand(10, 10000) ?></h5>
                                            <span class="description-text">POST</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo rand(10, 100) ?></h5>
                                            <span class="description-text">PENGADUAN</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <button class="btn btn-primary fa fa-search" name="read" value="<?php echo $r['id'] ?>"></button>
                                            <button class="btn btn-danger fa fa-trash"></button>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
</div>