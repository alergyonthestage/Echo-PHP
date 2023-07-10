<view-head>
    <link rel="stylesheet" href="/public/css/views/friendship.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
</view-head>
    <ul class="friendship-list">
        <?php foreach ($data as $friend):  ?>
            <li class="friendship-item">
                <a href="/user/<?=$friend->getUsername()?>">
                <div class="friendship-friend">
                    <div class="profile-picture-frame friendship-profile-picture-frame">
                        <img class="profile-picture" src="<?=$friend->getPic()?>" alt="Profile picture">
                    </div>
                    <div class="friendship-friend-infos">
                        <div class="friendship-friend-name">
                           <p><?=$friend->getName()." ",$friend->getSurname()?><?php if($friend->isVerified()) {echo '<i class="fas fa-check-circle" title="Profilo verificato"></i>';}?></p>
                        </div>
                        <div class="friendship-friend-username">
                            <p>@<?=$friend->getUsername()?></p>
                        </div>
                    </div> 
                </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
