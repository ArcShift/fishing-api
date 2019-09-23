<?php 
//print_r($this->input->post());
$i=1;
?>
<div class="box">
    <form method="post">
        <div class="box-body">
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
        </div>
    </form>
</div>