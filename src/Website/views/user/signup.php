<view-head>
    <link rel="stylesheet" href="/public/css/utils.css">
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <script type="module" src="/public/javascript/forms/signup.js"></script>
</view-head>
<div class="centered-form-container">
    <form action="/signup" method="POST" id="signup-form" class="centered-form">
        <div class="centered-form-field-container">
            <div class="centered-form-field">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" required>
            </div>
            <div class="centered-form-field">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="centered-form-field">
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname" required>
            </div>
            <div class="centered-form-field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="centered-form-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="8" required> 
            </div>
            <div class="centered-form-field">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" id="confirm-password" minlength="8" required>
            </div>
            <div class="show-password unselectable">
                <input type="checkbox" id="show-password">
                <label for="show-password">Show password</label>
            </div>
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Sign Up" class="primary-button">
        </div>
    </form>
</div>