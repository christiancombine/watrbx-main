
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Page");
$pagebuilder->buildheader();

global $db;

$alljobs = [];

$alljobs = $db->table("jobs")->where("type", 1)->get();


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.20/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.20/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.20/mode/lua/lua.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.20/theme/material.min.css" integrity="sha512-jA21084nir3cN96YuzJ1DbtDn30kxhxqQToAzCEGZcuRAswWfYirpUu8HVm8wRNoWDCYtA4iavd2Rb1bQSLv7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="main-content">

    <form action="/api/v1/perform-lua" method="POST">
        <h1>Execute Lua</h1>
        <br><br><br><br>
        <select name="jobid">
            <option value="">Select a Job</option>
            
            <?php 
                foreach ($alljobs as $job){ ?>
                    <option value="<?=$job->jobid?>"><?=$job->jobid?> (ID: <?=$job->assetid?>)</value>
                <? } ?>
        </select>
        <br><br>
        <div style="width: 500px; height: 415px;">
            <textarea name="lua" id="codeEditor" style="width: 500px; height: 400px;"></textarea>
        </div>
        <button>Execute</button>
    </form>
<script>

var editor = null;

window.addEventListener('DOMContentLoaded', function() {
    editor = CodeMirror.fromTextArea(document.getElementById("codeEditor"), {
        mode: "lua",
        theme: "material",
        lineNumbers: false
    });
});

window.addEventListener('load', function() {
    editor.refresh();
});
</script>

<style>
.editor-container {
    width: 100%;
    max-width: 800px;
}

.CodeMirror {
    height: 400px;
    border: 1px solid #ccc;
}
</style>
</div>
</body>
</html>