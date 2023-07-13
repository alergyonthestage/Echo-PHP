<view-head>
    <link rel="stylesheet" href="/public/css/views/notifications.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/badge.css">
    <link rel="stylesheet" href="/public/css/utils.css">
</view-head>
<div id="notifications">
    <h4>Nuove (<?=count($data['notifications_toread'])?>): </h4>
    <ul class="notifications-list">
        <?php if(count($data['notifications_toread']) == 0) echo '<p class="alert">Nessuna nuova notifica</p>'; ?>
        <?php foreach ($data['notifications_toread'] as $notification):  ?>
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
                            <?php if($notification->getTypeID() == 1 || $notification->getTypeID() == 2): ?>
                                <a href="/post/<?=$notification->getPostID()?>">
                                    Vai al post >
                                </a>
                            <?php else: ?>
                                <a href="/user/<?=$notification->getSender()->getUsername()?>">
                                    Vai al profilo >
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="notifications-notification-timeago">
                            <p><?=$notification->getTimeAgo()?></p>
                        </div>
                    </div> 
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <h4>Già lette (<?=count($data['notifications_read'])?>): </h4>
    <?php if(count($data['notifications_read']) == 0) echo '<p class="alert">Nessuna vecchia notifica</p>'; ?>
    <ul class="notifications-list">
        <?php foreach ($data['notifications_read'] as $notification):  ?>
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
                            <?php if($notification->getTypeID() == 1 || $notification->getTypeID() == 2): ?>
                                <a href="/post/<?=$notification->getPostID()?>">
                                    Vai al post >
                                </a>
                            <?php else: ?>
                                <a href="/user/<?=$notification->getSender()->getUsername()?>">
                                    Vai al profilo >
                                </a>
                            <?php endif; ?>
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
