<view-head>
    <link rel="stylesheet" href="/public/css/utils.css">
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <script type="module" src="/public/javascript/forms/login.js"></script>
</view-head>
<div class="centered-form-container">
    <form action="/login" method="POST" id="login-form" class="centered-form">
        <div class="centered-form-field-container">
            <?php if(isset($error)) {
                echo '<div class="error">'.$error.'</div>';
            }?>
            <div class="centered-form-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="centered-form-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="8"  required>
                <div class="show-password unselectable">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">Show password</label>
                </div>
            </div>
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Log In" class="primary-button">
        </div>
    </form>
</div>