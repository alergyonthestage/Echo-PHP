<view-head>
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
</view-head>
<div class="centered-form-container">
    <form action="/login" method="POST" class="centered-form">
        <div class="centered-form-field">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div class="centered-form-field">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Log In" class="primary-button">
        </div>
    </form>
</div>