<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("User Search");
$pagebuilder->buildheader();

?>
    <div class="main-content">
        <a style="margin-left: 44px">Lookup Tool</a>
        <a href="/find-alt" style="margin-left: 44px">Alt Tool</a>
        <hr class="secondhr">
        <br>
        <br>
        <div class="header">
            <h1>User</h1>
        </div>
        <br>
        <div class="form-content">
            <div class="form-group">

                <span for="preset-message" class="bold marginleft">UserName</span>
                <input id="searchingusername" class="lookup">
                <button id="usernamesubmit">Submit</button>
            </div>
        </div>
        <div class="results hidden" id="resultsid">
            <h1>User Search Results</h1>
            <div class="resultstable">
                <table>
                    <thead>
                        <tr>
                            <th class="bold bigger">Name</th>
                            <th class="bold bigger">ID</th>
                            <th class="bold bigger">Online</th>
                            <th class="bold bigger">Email</th>
                            <th class="bold bigger">Roleset</th>
                            <th class="bold bigger">Creation Date</th>
                            <th class="bold bigger">Last Activity</th>
                            <th class="bold bigger">Action</th>
                            <th class="bold bigger">Send Personal Message</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const username_button = document.getElementById("usernamesubmit");
        const usernamebox = document.getElementById("searchingusername");
        const table = document.getElementById("tablebody");
        const resultsdiv = document.getElementById("resultsid");

        let username = '';

        username_button.addEventListener("click", function (event) {
            event.preventDefault();
            search_user();
        });

        function update_username() {
            username = usernamebox.value.trim();
        }

        function search_user() {
            update_username();

            const params = new URLSearchParams();
            params.append("username", username);

            fetch('/api/v1/get-user-info', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: params.toString()
            })
            .then(response => response.json())
            .then(data => {
                const url = `https://www.watrbx.xyz/users/${data.id}/profile`;
                const msgurl = `/${data.id}/send-message`;

                const tabledata = [
                    { type: "link", text: data.name, href: url },
                    { type: "text", text: data.id },
                    { type: "text", text: data.online },
                    { type: "text", text: data.email },
                    { type: "text", text: data.roleset },
                    { type: "text", text: data.creationdate },
                    { type: "text", text: data.lastactivity },
                    { type: "link", text: "Perform Action", href: "/view/" + data.id },
                    { type: "link", text: "Send Personal Message", href: msgurl }
                ];

                const tr = document.createElement("tr");

                tabledata.forEach(item => {
                    const td = document.createElement("td");
                    td.classList.add("bigger");

                    if (item.type === "link") {
                        const a = document.createElement("a");
                        a.textContent = item.text;
                        a.href = item.href;
                        td.appendChild(a);
                    } else {
                        td.textContent = item.text;
                    }

                    tr.appendChild(td);
                });

                table.innerHTML = '';
                table.appendChild(tr);
            })
            .catch(error => console.error('Error:', error));
            resultsdiv.classList.remove("hidden");
        }


    </script>
</body>
</html>