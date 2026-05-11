
<?php 
use watrlabs\watrkit\pagebuilder;
use watrbx\thumbnails;
use watrlabs\authentication;
$auth = new authentication();
$thumbs = new thumbnails();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Asset Queue");
$pagebuilder->buildheader();



global $db;

$assetinfo = $db->table("assets")->where("moderation_status", "Pending")->first();

if($assetinfo == null){ ?>

    <div class="main-content">
        <h1>Nothing to review</h1>
    </div>
</body>
</html>

<? 
die(); }

$thumb = $thumbs->get_asset_thumb($assetinfo->id);
$ownerinfo = $auth->getuserbyid($assetinfo->owner);

?>
<div class="main-content">

    <h2><?=$assetinfo->name?></h2>
    <img src="<?=$thumb?>" style="width: 512;">
    <?php
        if($assetinfo->prodcategory == 3){ ?> <br><audio controls src="//cdn.watrbx.wtf/<?=$assetinfo->fileid?>">update ur browser nerd</audio> <? } ?>
    <br><br>
    <a href="/api/v1/approve-asset?id=<?=$assetinfo->id?>">Approve</a> - <a href="/api/v1/deny-asset?id=<?=$assetinfo->id?>">Deny</a>
    <br>
    <p>Uploaded by: <a href="/view/<?=$ownerinfo->id?>"><?=$ownerinfo->username?></a></p>
</div>
</body>
</html>