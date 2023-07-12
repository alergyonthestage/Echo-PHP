<view-head>
    <link rel="stylesheet" href="/public/css/views/notifications.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/badge.css">
    <link rel="stylesheet" href="/public/css/utils.css">
</view-head>
<div id="notifications">
    <ul class="notifications-list">
        <?php foreach ($data as $notification):  ?>
            <li class="notifications-item">
                <div class="notifications-notification">
                    <div class="profile-picture-frame notifications-profile-picture-frame">
                        <a href="/user/<?=$notification->getSender()->getUsername()?>">
                            <img class="profile-picture" src="<?=$notification->getSender()->getPic()?>" alt="Profile picture">
                        </a>
                    </div>
                    <div class="notifications-notification-infos">
                        <div class="notifications-notification-description">
                           <p>
                                <a href="/user/<?=$notification->getSender()->getUsername()?>">
                                    <b><?="@".$notification->getSender()->getUsername()." "?></b>
                                </a>
                                <?php if($notification->getSender()->isVerified()) {echo '<i class="fas fa-check-circle" title="Profilo verificato"></i>';}?>
                                <?=$notification->getTypeDescription()?>
                            </p>
                        </div>
                        <div class="notifications-notification-action">
                            <a href="/post/<?=$notification->getPostID()?>"><b>Vai al post ></b></a>
                        </div>
                        <div class="notifications-notification-timeago">
                            <p><?=$notification->getTimeAgo()?></p>
                        </div>
                    </div> 
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
