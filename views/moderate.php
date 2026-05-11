<?php 
use watrlabs\watrkit\pagebuilder;
use watrlabs\authentication;
$auth = new authentication();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Moderate A User");
$pagebuilder->buildheader();

$userinfo = $auth->getuserbyid($userid);

if($userinfo == null){
    die('<div class="main-content"><h1>User does not exist.</h1></div></body></html>');
}


?>
<div class="main-content">
        <div class="header">
            <h1><?=$userinfo->username?></h1>
            <br><br>
            <a class="home" href="/">Home Page</a>
        </div>
        <div class="form-group">
        <? if($userinfo->is_admin == 1){ echo '<div style="background-color: #fff3cd; color: #856404; font-weight: bold; padding: 10px; border-radius: 5px; margin-bottom: 20px;">User is protected!</div>'; } ?>
        <div style="background-color: rgba(1, 132, 232, 0.52);; color:rgb(0, 0, 0); font-weight: bold; padding: 10px; border-radius: 5px; margin-bottom: 20px;">Please keep a professional tone for the moderator note.</div>
            <label>Account State Override:</label>
            <form action="/api/v1/moderate-user" method="POST">
            <input type="text" name="userid" value="<?=$userinfo->id?>" class="hidden">
                <div>
                    <input type="radio" name="account-state" value="remind" id="remind"><span for="remind">Reminder</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="warn" id="warn"><span for="warn">Warn</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="ban1" id="ban1"><span for="ban1">Ban 1 Day</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="ban3" id="ban3"><span for="ban3">Ban 3 Days</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="ban7" id="ban7"><span for="ban7">Ban 7 Days</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="ban14" id="ban14"><span for="ban14">Ban 14 Days</span>
                </div>
                <div>
                    <input type="radio" name="account-state" value="delete" id="delete"><span for="delete">Delete</span>
                </div>
                <br>
                <div>
                    <input type="checkbox" name="ipban" id="ipban" value="yes"><span for="ipban">IP Ban</span>
                </div>
                <div>
                    <input type="checkbox" name="wipeusername" id="wipeusername" value="yes"><span for="delete">Wipe Username</span>
                </div>

            </div>
            <div class="form-group">
                <label for="user-message">Message to User:</label>
                <textarea id="user-message" name="moderatornote"></textarea>
            </div>
            <div class="form-group">
                <label for="internal-note">Internal Moderation Note:</label>
                <textarea id="internal-note" name="internalnote"></textarea>
            </div>
            <button id="submitbtn">Submit</button>
        </form>
        <div class="hidden">
            <span style="color: green; margin-top: 16px;">✔Action completed successfully.</span>
        </div>
    </div>
</body>
</html>