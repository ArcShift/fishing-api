<div class="box">
    <div class="box-body">
        <a class="btn btn-primary fa fa-plus" href=""></a>
        <form action="<?php echo site_url('user/detail'); ?>" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>User Type</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data1 as $r) { ?>
                        <tr>
                            <td></td>
                            <td><?php echo $r['nama'] ?></td>
                            <td><?php echo $r['type'] ?></td>
                            <td>
                                <button class="btn btn-primary fa fa-edit"></button>
                                <button class="btn btn-danger fa fa-trash"></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>