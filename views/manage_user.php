
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Manage User");
$pagebuilder->buildheader();
?>
<div class="main-content">
    <? if($userinfo->is_admin == 1){ echo '<div style="background-color: #fff3cd; color: #856404; font-weight: bold; padding: 10px; border-radius: 5px; margin-bottom: 20px;">User is protected!</div>'; } ?>
    <div class="header">
        <h1>Manage <?=$userinfo->username?></h1>
        <br><br>
        <a class="home" href="/">Home Page</a>
    </div>

    <p>
        
        Choose an action for this user.

        <br><br>

        <a href="/moderate/<?=$userinfo->id?>">Moderate</a><br>
        <a href="/<?=$userinfo->id?>/send-message">Personal Message</a><br>
        <a href="/manage/<?=$userinfo->id?>">Manage Info</a><br>
        <a href="/inventory/<?=$userinfo->id?>">Inventory</a><br>
        <a href="/award/<?=$userinfo->id?>">Award</a><br>

    </p>
    
    

</div>
</body>
</html>