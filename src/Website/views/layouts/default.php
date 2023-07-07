<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/public/javascript/menu.js" defer></script>
    <title>Echo</title>
</head>
<body>
    <header>
        <button id="hystory-back-button" class="unselectable fa-solid fa-caret-left" onclick="history.go(-1);"></button>
        <div id="logo" class="unselectable"><a href="/">ECHO</a></div>
        <button id="show-menu-button" class="unselectable fa-solid fa-ellipsis-vertical" onclick="expand()"></button>
        <nav id="menu">
            <a href="/login" class="unselectable">Log In</a><hr>
            <a href="/signup" class="unselectable">Sign Up</a>
        </nav>
    </header>
    <main>
        {{content}}
    </main>
</body>
</html>