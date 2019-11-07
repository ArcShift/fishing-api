<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <?php
                if (empty($data['url_photo'])) {
                    $url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png';
                }else{
                    $url = base_url('upload/profil/').$data['url_photo'];
                }
                echo '<img src="'.$url.'" width="100px" height="100px"/>';
                ?>
            </div>
            <div class="col-sm-10">
                <p><?php echo $data['name'] ?></p>
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-header">
        <button class="btn btn-primary pull-right" onclick="window.location.reload()">Kembali</button>
    </div>
    <div class="panel-body">
        <form class="form-horizontal">
            <?php foreach ($data as $key => $value) { ?>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label"><?php echo $key ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" id="nama" name="nama" value="<?php echo $value ?>" disabled="">
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</div>