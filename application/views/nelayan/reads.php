<?php
//print_r($this->input->post());
//print_r($this->session->userdata('pagination'));
$i = 1+(($pagination['page']-1)*$this->config->item('page_limit'));
?>
<div class="box">
    <form method="post">
        <div class="box-body">
            <small class="label label-default">Total data: <?php echo $dataCount ?></small>
            <button class="btn btn-primary fa fa-th pull-right" name="view" value="thumnail"></button>
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
            <?php $this->load->view('addon/pagination') ?>
        </div>
    </form>
</div>