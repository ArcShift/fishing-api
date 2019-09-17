<div class="box">
    <div class="box-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="inputNama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <select class="form-control">
                        <?php foreach ($roles as $r) { ?>
                            <option value="<?php echo $r['id'] ?>"><?php echo $r['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>
        <form method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Modul</th>
                        <th>Read</th>
                        <th>Insert</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $m) { ?>
                        <tr>
                            <td>
                                <b><?php echo $m['nama'] ?></b>
                                <?php echo '~' . $m['induk'] ?>
                            </td>
                            <td><input type="checkbox" name="read[<?php echo $m['id'] ?>]"/></td>
                            <td><input type="checkbox" name="insert[<?php echo $m['id'] ?>]"/></td>
                            <td><input type="checkbox" name="update[<?php echo $m['id'] ?>]"/></td>
                            <td><input type="checkbox" name="delete[<?php echo $m['id'] ?>]"/></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button class="btn btn-primary pull-right" name="update" value="ok">Simpan</button>
        </form>
    </div>
</div>