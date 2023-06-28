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
                <?=$username?> <?=$suffix?>
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
                <div class="user-profile-stat">
                    <div>
                        <?=$friends?>
                    </div>
                    <div class="secondary-text">
                        Friends
                    </div>
                </div>
            </div>
            <button class="user-profile-add-friend-button">Add</button>
        </div>
    </div>
    <div class="user-profile-biography">
        <div class="important-text"><?=$name?></div>
        <div class="secondary-text"><?=$biography?></div>
    </div>
</div>