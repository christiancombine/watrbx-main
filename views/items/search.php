
<?php 
use watrlabs\watrkit\pagebuilder;
use watrbx\sitefunctions;
$pagebuilder = new pagebuilder();
use watrbx\thumbnails;
$thumbs = new thumbnails();
$func = new sitefunctions();
$pagebuilder->set_page_name("Item Search");
$pagebuilder->buildheader();

global $db;

?>
<div class="main-content">

    <div class="form-content">
        <div class="form-group">
            <form action="/items/search" method="POST">
                <span for="preset-message" class="bold marginleft">Item ID</span>
                <input name="itemid" class="lookup">
                <button>Submit</button>
            </form>
        </div>
    </div>

    <?php if(isset($assetinfo)){ 
        $thumb = $thumbs->get_asset_thumb($assetinfo->id);
        $sold = $db->table("ownedassets")->where("assetid", $assetinfo->id)->count();
        ?>

        <table>
        <thead>
            <tr>
                <th class="bold bigger">Thumbnail</th>
                <th class="bold bigger">Asset ID</th>
                <th class="bold bigger">Name</th>
                <th class="bold bigger">Sold</th>
                <th class="bold bigger">Type</th>
                <th class="bold bigger">File Name</th>
                <th class="bold bigger">Manage</th>
            </tr>
        </thead>
        <tbody id="tablebody">
                            <tr>
                    <td class="bigger"><img style="height: 250px;" src="<?=$thumb?>"></td>
                    <td class="bigger"><?=$assetinfo->id?></td>
                    <td class="bigger"><?=$assetinfo->name?></td>
                    <td class="bigger"><?=$sold?></td>
                    <td class="bigger"><?=$func->get_friendly_name($assetinfo->prodcategory)?></td>
                    <td class="bigger"><?=$assetinfo->fileid?></td>
                    <td class="bigger"><a href="/items/<?=$assetinfo->id?>/manage">Manage</a></td>
                </tr>
        </tbody>
    </table>

    <? } ?>
        

</div>
</body>
</html>