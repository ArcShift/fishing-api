<div class="panel no-rounded-corner bg-inverse text-white wrapper m-b-0">
    <canvas id="mainGraph" height="100"></canvas>
</div>
<script>
    var ctx = document.getElementById('mainGraph').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'May', 'June', 'July', 'Agustus', 'September','Oktober','November', 'Desember'],
            datasets: [{
                    label: 'Nama Ikan',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                },
                {
                    label: 'Nama Ikan 2',
                    backgroundColor: 'rgb(255, 255, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                }]
        },
        options: {}
    });
</script>
<div class="panel pagination-inverse bg-white clearfix no-rounded-corner m-b-0">
    <!-- begin table -->
    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="width-100">Month</th>
                <th>Orders</th>
                <th>Earning</th>
                <th data-sorting="disabled"></th>
                <th class="width-50" data-sorting="disabled"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>January</td>
                <td>1,929 items sold</td>
                <td>$19,290</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>February</td>
                <td>1,392 items sold</td>
                <td>$13,920</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>March</td>
                <td>988 items sold</td>
                <td>$9,880</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>April</td>
                <td>780 items sold</td>
                <td>$7,800</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>May</td>
                <td>1,023 items sold</td>
                <td>$10,230</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>June</td>
                <td>502 items sold</td>
                <td>$5,020</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>July</td>
                <td>1,499 items sold</td>
                <td>$14,990</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>August</td>
                <td>684 items sold</td>
                <td>$6,840</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>September</td>
                <td>433 items sold</td>
                <td>$4,330</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>October</td>
                <td>581 items sold</td>
                <td>$5,810</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>November</td>
                <td>1,239 items sold</td>
                <td>$12,390</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
            <tr>
                <td>December</td>
                <td>893 items sold</td>
                <td>$8,930</td>
                <td class="p-5"><div data-render="sparkline"></div></td>
                <td class="p-5"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> View Details</a></td>
            </tr>
        </tbody>
    </table>
    <!-- end table -->
</div>
