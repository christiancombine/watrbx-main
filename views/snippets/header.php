<?php

    global $db;

    use watrlabs\authentication;
    $auth = new authentication();
    $userinfo = $auth->getuserinfo($_COOKIE["_ROBLOSECURITY"]);

    $pendingassets = $db->table("assets")->where("moderation_status", "Pending")->count();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title><?=$config["title"] ?? "Untitled Page" ?> | Roblox CS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            zoom: 67%;
        }
        .sidebar {
          height: 500px;
          margin-top: 70px;
          margin-left: 40px;
          margin-right: 40px;
          margin-bottom: 0;
          width: 350px; 
          border-top: 1px solid #2578BB;
          border-right: 1px solid #2578BB;
          border-left: 1px solid #2578BB;
          border-bottom: 1px solid #2578BB;
          border-radius: 6px;
          z-index: 1;
          overflow-y: auto;
        }
        .section {
            border-bottom: 4px solid #e0e0e0;
            background-color: #f4f4f4;
            padding: 15px;
            height: 15px;
            width: 98.7%;
            position: absolute;
            justify-content: space-between;
        }
        .welcome {
            float: right;
        }
        .home {
            position: absolute;
            margin-top: 55px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-top: 70px;
        }
        h1 {
            margin-top: 0;
            font-weight: normal;
            position: absolute;
            margin-top: 30px;
        }
        h2 {
            font-size: 18px;
            color: white;
            background-color: #2578BB;
            padding: 20px;
            margin-top: -5px;
            height: 15px;
            font-weight: normal;
        }
        h3 {
            margin-left: 15px;
            font-size: 16px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin-left: 15px;
        }
        li {
            margin-bottom: 5px;
        }
        a {
            text-decoration: none;
            color: #3498db;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            margin-top: 30px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="radio"] {
            margin-right: 5px;
            height: 15px;
        }
        select, textarea {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        textarea {
            height: 100px;
        }
        button {
            height: 50px;
            width: 90px;
            background-color: #2578BB;
            color: white;
            border-radius: 6px;
            font-size: 20px;
            margin-left: 8px;
        }
        select {
            width: 400px;
        }
        textarea {
            width: 388px;
        }
        hr {
            width: 90%;
            margin-left: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 1em;
        }
        .gray {
            color: gray;
        }
        .secondhr {
            margin-left: 0px;
            width: 252px;
            margin-top: 12px;
        }
        .bold {
            font-weight: bold;
        }
        .lookup {
            margin-left: 48px;
            height: 36px;
            width: 256px;
            border-radius: 4px;
        }
        .marginleft {
            margin-left: 16px;
        }
        .margintop {
            margin-top: 8px;
        }
        .marginright {
            margin-left: 20px;
        }
        .marginright2 {
            margin-left: 9px;
        }
        button:hover {
            cursor: pointer;
        }
        button:active {
            background-color: #2068a0;
        }
        .resultstable {
            margin-top: 96px;
            position: absolute;
        }
        th, td {
            border: 1px solid;
            border-color: lightgray;
            padding: 2vh;
            text-align: left;
        }
        .bigger {
            font-size: 20px;
        }
        .red {
            background-color: red;
            color: red;
        }
        .hidden {
            display: none;
        }
        input {
            font-size: 22px;
        }
        #cs-text {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="section">
        <span><a href="/" id="cs-text">Customer Service & Moderation</a></span>
        <div class="welcome">Hi <?=$userinfo->username?> (<a href="#">logout</a>)</div>
    </div>
    <div class="sidebar">
        <h2>Customer Service</h2>
        <h3>User Admin</h3>
        <hr style=";">
        <ul>
            <li><a href="/">Find user</a></li>
            <li><a href="/logs">Recent Action</a></li>
            <li><a href="/server-info">Server Info</a></li>
        </ul>
        <h3>Misc</h3>
        <hr style=";">
        <ul>
            <li><a href="/config">Site Configuration</a></li>
        </ul>
        <h3>Gameserver Management</h3>
        <hr style=";">
        <ul>
            <li><a href="/gameserver/open-jobs">Open Jobs</a></li>
        </ul>
        <h3>Item Management</h3>
        <hr style=";">
        <ul>
            <li><a href="/items/queue">Asset Queue (<?=$pendingassets?>)</a></li>
            <li><a href="/items/search">Search</a></li>
        </ul>
        
    </div>