
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Page");
$pagebuilder->buildheader();

global $db;
$ownedassets = $db->table("ownedassets")->where("userid", $userinfo->id)->get();

?>
<div class="main-content">

    <h1><?=$userinfo->username?>'s inventory:</h1>
    <br><br><br><br>
    <table>
        <thead>
            <tr>
                <th class="bold bigger">Name</th>
                <th class="bold bigger">Date Bought</th>
                <th class="bold bigger">Manage</th>
                <th class="bold bigger">Delete</th>
            </tr>
        </thead>
        <tbody id="tablebody">
            <?php

            foreach($ownedassets as $asset){ 
                $assetinfo = $db->table("assets")->where("id", $asset->assetid)->first();
                if($assetinfo){
                ?>
                <tr>
                    <td class="bigger"><?=$assetinfo->name?></td>
                    <td class="bigger"><?=date('Y-m-d H:i:s',  $asset->time)?></td>
                    <td class="bigger"><a href="/items/<?=$assetinfo->id?>/manage">Manage Item</a></td>
                    <td class="bigger"><a href="/inventory/<?=$userinfo->id?>/delete/<?=$assetinfo->id?>">Delete From Inventory</a></td>
                </tr>
            <? }} ?> 
        </tbody>
    </table>

</div>
</body>
</html>