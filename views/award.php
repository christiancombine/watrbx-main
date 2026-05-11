
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
            <h1>Award <?=$userinfo->username?></h1>
            <br><br>
            <a class="home" href="/view/<?=$userinfo->id?>">Back</a>

            <br><br><br><br>

            <div class="form-content">
                <div class="form-group">

                <form action="/api/v1/award-item" method="POST">

                    <h2>Award Item</h2>

                    <input type="text" name="userid" value="<?=$userinfo->id?>" class="hidden">

                    <span for="preset-message" class="bold marginleft">Item ID</span>
                    <input id="searchingusername" name="itemid" class="lookup">
                    <button id="usernamesubmit">Submit</button>

                </form>
                </div>
            </div>

            <br><br>

            <div class="form-content">
                <div class="form-group">

                <form action="/api/v1/award-currency" method="POST">

                    <h2>Award Currency</h2>

                    <input type="text" name="userid" value="<?=$userinfo->id?>" class="hidden">

                    <span for="preset-message" class="bold marginleft">Robux</span>
                    <input id="searchingusername" type="integer" name="robux" class="lookup">
                    <br><br>
                    <span for="preset-message" class="bold marginleft">Tix</span>
                    <input id="searchingusername" type="integer" name="tix" class="lookup">
                    <br><br>
                    <button id="usernamesubmit">Submit</button>

                </form>
                </div>
            </div>

            <div class="form-content">
                <div class="form-group">

                <form action="/api/v1/award-membership" method="POST">

                    <h2>Award Membership</h2>

                    <input type="text" name="userid" value="<?=$userinfo->id?>" class="hidden">
                    <select name="membership">
                        <option value="None">None</option>
                        <option value="BuildersClub">Builders Club</option>
                        <option value="TurboBuildersClub">Turbo Builders Club</option>
                        <option value="OutrageousBuildersClub">Outrageous Builders Club</option>
                    </select>
                    <br><br>
                    <button id="usernamesubmit">Submit</button>

                </form>
                </div>
            </div>

    </div>        

</div>
</body>
</html>