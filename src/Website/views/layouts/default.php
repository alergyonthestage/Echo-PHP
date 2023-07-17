<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/layout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script type="module" src="/public/javascript/menu.js"></script>
    <title>Echo</title>
</head>
<body>
    <header>
        <div id="fixed-header">
            <button id="hystory-back-button" class="unselectable fa-solid fa-caret-left"></button>
            <h1 id="logo" class="unselectable"><a href="/">ECHO</a></h1>
            <button id="show-menu-button" class="unselectable fa-solid fa-ellipsis-vertical"></button>
        </div>
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