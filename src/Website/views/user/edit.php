<view-head>
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <link rel="stylesheet" href="/public/css/views/edit.css">
    <script type="module" src='/public/javascript/user/profileImageUpload.js'></script>
    <script type="module" src='/public/javascript/forms/editProfile.js'></script>
</view-head>
<div class="centered-form-container">
    <input type="file" id="file-selector"/>
    <form action="/userinfo/edit" method="post" id="edit-profile-form" class="centered-form edit-profile-form">
        <div class="edit-profile-picture-container">
            <div id="edit-profile-picture-button" class="profile-picture-frame profile-picture-edit">
                <img class="profile-picture edit-profile-picture-filter" src="<?=$profileURI?>" alt="Profile picture">
            </div>
            <em class="fa-solid fa-user-pen"></em>
        </div>
        <div class="centered-form-field-container">
            <div class="centered-form-field">
                <label for="username">Username</label>
                <input id="username" type="username" name="username" value="<?= $username?>" required>
            </div>
            <div class="centered-form-field">
                <label for="name">Name</label>
                <input id="name"  type="text" name="name" value="<?= $name?>" required>
            </div>
            <div class="centered-form-field">
                <label for="surname">Surname</label>
                <input id="surname"  type="text" name="surname" value="<?= $surname?>" required>
            </div>
            <div class="centered-form-field">
                <label for="biography">Biography</label>
                <textarea name="biography" id="biography" rows="6"><?= $biography?></textarea>
            </div>
            <div class="centered-form-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= $email?>" required>
            </div>
            <div class="centered-form-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" minlength="8">
            </div>
            <div class="centered-form-field">
                <label for="confirm-password">Confirm Password</label>
                <input id="confirm-password" type="password" name="confirm-password" minlength="8">
            </div>
            <div class="show-password unselectable">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">Show password</label>
                </div>
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Confirm your changes" class="primary-button">
        </div>
    </form>
</div>