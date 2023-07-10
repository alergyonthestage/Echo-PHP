<view-head>
    <script type="module" src='/public/javascript/profileImageUpload.js'></script>
</view-head>
<div class="centered-form-container">
    <link rel="stylesheet" href="/public/css/views/user.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <div class="profile-picture-frame user-profile-picture-frame user-profile-picture-edit">
        <img class="profile-picture user-profile-picture-filter" src="<?=$profileURI?>" alt="Profile picture">
        <button id='edit-profile-picture-button' class="user-profile-picture-edit-button" type="button">
            <input type="file" id="file-selector"/>
        </button>
    </div>
    <form action="/userinfo/edit" method="post" class="centered-form" enctype="multipart/form-data">
        <div class="centered-form-field">
            <label for="username">Username</label>
            <input type="username" name="username" value="<?= $username?>">
        </div>
        <div class="centered-form-field">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $name?>">
        </div>
        <div class="centered-form-field">
            <label for="surname">Surname</label>
            <input type="text" name="surname"  value="<?= $surname?>">
        </div>
        <div class="centered-form-field">
            <label for="biography">Biography</label>
            <input type="text" name="biography"  value="<?= $biography?>">
        </div>
        <div class="centered-form-field">
            <label for="email">Email</label>
            <input type="email" name="email"  value="<?= $email?>">
        </div>
        <div class="centered-form-field">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div class="centered-form-field">
            <label for="confirm-password">Confirm Password</label>
            <input type="confirm-password" name="confirm-password">
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Confirm your changes" class="button-action-text">
        </div>
    </form>
</div>