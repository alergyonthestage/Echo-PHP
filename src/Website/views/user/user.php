<view-head>
    <link rel="stylesheet" href="/public/css/views/user.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/badge.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <script type="module" src="/public/javascript/user/userPostsGrid.js"></script>
</view-head>
<div class="user-profile-header">
    <div class="profile-picture-frame user-profile-picture-frame">
        <img class="profile-picture" src="<?=$profileURI?>" alt="Profile picture">
    </div>
    <div class="user-profile-infos">
        <div class="important-text user-profile-username">
            <?=$username?> <?php if($verified) {echo '<em class="fas fa-check-circle" title="Profilo verificato"></em>';}?>
        </div>
        <div class="user-profile-stats">
            <div class="user-profile-stat">
                <div class="secondary-text">
                    <?=$posts?>
                </div>
                <div class="secondary-text">
                    Posts
                </div>
            </div>
            <a href="/user/<?=$username?>/friends">
            <div class="user-profile-stat">
                <div class="secondary-text">
                    <?=$friends?>
                </div>
                <div class="secondary-text">
                    Friends
                </div>
            </div>
            </a>
        </div>
        <?php if($selfProfile): ?>
            <a href="/userinfo/edit" class="user-profile-action-button primary-button">Edit profile</a>
        <?php else: ?>
            <div id="user-profile-action-button-container" class="user-profile-action-button-container" relation="<?=$relation?>" profile-id="<?=$profileID?>"></div>
            <script type="module" src="/public/javascript/user/userProfileActionButton.js"></script>
        <?php endif; ?>
    </div>
</div>
<div class="user-profile-biography">
    <div class="important-text"><?=$name?></div>
    <div class="secondary-text user-profile-biography-text"><?=$biography?></div>
</div>
<div id="user-profile-posts-grid" user="<?=$profileID?>"></div>
<a href="/notifications" class="floating-notification-button">
  <div class="fa-regular fa-bell fa-2xl"></div>
  <?php if($notificationsCounter > 0): ?>
    <div class="notification-counter">
      <?=$notificationsCounter?>
    </div>
  <?php endif; ?>
</a>
