<form class="form-horizontal">
    <div class="panel">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input class="form-control" value="<?php echo $dataLaporan['name'] ?>" readonly/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input class="form-control" value="<?php echo $dataLaporan['description'] ?>" readonly/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control">
                        <option>--</option>
                        <option>--</option>
                        <option>--</option>
                        <option>--</option>
                    </select>
                </div>
            </div>
            <?php foreach ($dataFiles as $f) { ?>
                <img src="<?php echo base_url('upload/pengaduan/') . $f['url_file'] ?>" height="150px"/>
            <?php } ?>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Kembali</button>
            <button type="submit" name="save" value="ok" class="btn btn-primary pull-right">Simpan</button>
        </div>
    </div>
</form>
<?php // echo 'id:' . $this->session->userdata('id') ?>
<?php // print_r($dataLaporan) ?>
<br/>
<br/>
<br/>
<?php
//print_r($dataFiles)?>