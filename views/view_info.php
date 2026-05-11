
<?php 
use watrlabs\watrkit\pagebuilder;
use watrbx\thumbnails;
$thumbs = new thumbnails();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name($userinfo->username);
$pagebuilder->buildheader();
$body = $thumbs->get_user_thumb($userinfo->id, "1024x1024", "full");
?>
<div class="main-content">

    <div class="results" id="resultsid">
            <h1><?=$userinfo->username?></h1>
            <br><br>
            <a class="home" href="/view/<?=$userinfo->id?>">Back</a>
            <div class="resultstable">
                <table>
                    <thead>
                        <tr>
                            <th class="bold bigger">Avatar</th>
                            <th class="bold bigger">Username</th>
                            <th class="bold bigger">Membership</th>
                            <th class="bold bigger">Email</th>
                            <th class="bold bigger">Robux</th>
                            <th class="bold bigger">Tix</th>
                            <th class="bold bigger">Creation Date</th>
                            <th class="bold bigger">Last Activity</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">
                        <tr>
                            <td class="bigger"><img src="<?=$body?>" style="height: 250px;"></td>
                            <td class="bigger"><?=$userinfo->username?></td>
                            <td class="bigger"><?=$userinfo->membership?></td>
                            <td class="bigger"><?=$userinfo->email?></td>
                            <td class="bigger"><?=number_format($userinfo->robux)?></td>
                            <td class="bigger"><?=number_format($userinfo->tix)?></td>
                            <td class="bigger"><?=date("n/j/Y", $userinfo->regtime)?></td>
                            <td class="bigger"><?=date('Y-m-d H:i:s',$userinfo->last_visit)?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

</div>
</body>
</html>