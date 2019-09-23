<div class="box">
    <div class="box-header">
        <button class="btn btn-primary pull-right" onclick="window.location.reload()">Kembali</button>
    </div>
    <div class="box-body">
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