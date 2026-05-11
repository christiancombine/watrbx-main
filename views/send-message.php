<?php 
use watrlabs\watrkit\pagebuilder;
use watrlabs\authentication;
$auth = new authentication();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("PM A User");
$pagebuilder->buildheader();

$userinfo = $auth->getuserbyid($userid);

if($userinfo == null){
    die('<div class="main-content"><h1>User does not exist.</h1></div></body></html>');
}


?>
<div class="main-content">
        <form action="/api/v1/send-personal-message" method="POST">
            <input type="text" name="userid" value="<?=$userinfo->id?>" class="hidden">

            <div class="form-group">
                <label for="user-message">Subject:</label>
                <input type="text" id="user-message" name="subject">
            </div>

            <div class="form-group">
                <label for="user-message">Content:</label>
                <textarea type="text" id="internal-note" name="content"></textarea>
            </div>

            <button>Submit</button>
        </form>
        <div class="hidden">
            <span style="color: green; margin-top: 16px;">✔Action completed successfully.</span>
        </div>
    </div>
</body>
</html>