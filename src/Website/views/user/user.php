<view-head>
    <link rel="stylesheet" href="/public/css/views/userStyle.css">
</view-head>
<div>
    <div class="user-profile-header">
        <div class="profile-picture-frame user-profile-picture-frame">
           <img class="profile-picture" src="<?=$profileURI?>" alt="Profile picture">
        </div>
        <div class="user-profile-infos">
            <div class="important-text user-profile-username">
                <?=$username?> <?php if($verified) {echo '<i class="fas fa-check-circle" title="Profilo verificato"></i>';}?>
            </div>
            <div class="user-profile-stats">
                <div class="user-profile-stat">
                    <div>
                        <?=$echoes?>
                    </div>
                    <div class="secondary-text">
                        Echoes
                    </div>
                </div>
                <div class="user-profile-stat">
                    <div>
                        <?=$posts?>
                    </div>
                    <div class="secondary-text">
                        Posts
                    </div>
                </div>
                <a href="/user/<?=$username?>/friends">
                <div class="user-profile-stat">
                    <div>
                        <?=$friends?>
                    </div>
                    <div class="secondary-text">
                        Friends
                    </div>
                </div>
                </a>
            </div>
            <?php if ($selfProfile) { ?>
                <a href="/userinfo/edit" class="user-profile-action-button primary-button">Edit profile</a>
            <?php } else { ?>
                <?php switch ($relation) {
                        case 0: ?>
                        <form action="/addFriend" method="POST">
                            <input type="hidden" name="user_id" value="<?=$userId?>">
                            <button type="submit" class="user-profile-action-button primary-button">Add</button>
                        </form>
                        <?php break;
                        case 1: ?>
                        <button class="user-profile-action-button secondary-button" disabled>Request sent.</button>
                        <?php break;
                        case 2: ?>
                        <button class="user-profile-action-button secondary-button" disabled>You are friends.</button>
                        <?php break;
                        case 3: ?>
                        <button class="user-profile-action-button secondary-button" disabled>Wants to become your friend!</button>
                        <?php break; } ?>
            <?php } ?>
        </div>
    </div>
    <div class="user-profile-biography">
        <div class="important-text"><?=$name?></div>
        <div class="secondary-text"><?=$biography?></div>
    </div>
</div>