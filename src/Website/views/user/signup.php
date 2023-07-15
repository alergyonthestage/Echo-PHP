<view-head>
    <link rel="stylesheet" href="/public/css/components/form.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
</view-head>
<div class="centered-form-container">
    <form action="/signup" method="POST" class="centered-form">
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
            <input type="password" name="password" id="password" required>
        </div>
        <div class="centered-form-field">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" required>
        </div>
        <div class="centered-form-submit-button-container">
            <input type="submit" value="Sign Up" class="primary-button">
        </div>
    </form>
</div>