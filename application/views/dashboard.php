<!--WIDGET-->
<?php
$widgets = array(
    array("title" => "Admin", "color"=>"success", "icon"=>"user-secret", "value"=>$countAdmin, "note"=>"-", "progress"=>50, "url"=>"admin"),
    array("title" => "Nelayan", "color"=>"primary", "icon"=>"user", "value"=>$countFisherman, "note"=>"-","progress"=>50, "url"=>"nelayan"),
    array("title" => "Database Ikan", "color"=>"grey", "icon"=>"fish", "value"=>$countFish, "note"=>"-","progress"=>50, "url"=>"ikan"),
    array("title" => "Pengaduan", "color"=>"inverse-dark", "icon"=>"phone-volume", "value"=>$countPengaduan, "note"=>"tertangani 764", "progress"=>764/1834*100, "url"=>"pengaduan"),
);
?>
<div class="row">
    <?php foreach ($widgets as $w) { ?>
        <div class="col-sm-6 col-lg-3">
            <div class="widget widget-stat widget-stat-right bg-<?php echo $w['color']?> text-white">
                <div class="widget-stat-btn"><a href="javascript:;" data-click="widget-reload"><i class="fa fa-redo"></i></a></div>
                <div class="widget-stat-icon"><i class="fa fa-<?php echo $w['icon']?>"></i></div>
                <div class="widget-stat-info">
                    <div class="widget-stat-title"><?php echo $w['title']?></div>
                    <div class="widget-stat-number"><?php echo $w['value']?></div>
                </div>
                <div class="widget-stat-progress">
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $w['progress']?>%"></div>
                    </div>
                </div>
                <div class="widget-stat-footer text-left">
                    <a class="btn btn-default fa fa-search" href="<?php echo site_url($w['url'])?>"></a>
                    <?php // echo $w['note']?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>