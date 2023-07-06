<view-head>
    <link rel="stylesheet" href="/public/css/views/feedStyle.css">
</view-head>
<div class="feed-post">
    <div class="feed-covert-art">
        <div class="feed-cover-square">
            <img class="feed-cover-disc" src="<?=$cover_art?>" alt="Cover-Art"/>
            <button class="feed-play-button"><i class="fas fa-play"></i></button>
        </div>
    </div>
    <div class="feed-post-infos">
        <div class="feed-post-song-infos">
            <div class="feed-post-song-title">
                <p><?=$song_info?></p>
            </div>
            <div class="feed-song-progress-bar">
                <div class="feed-song-progress-bar-inner"></div>
            </div>
        </div>
        <div class="feed-post-header">
            <a href="/user/<?=$author_username?>">
                <div class="feed-post-author-infos">
                    <div class="profile-picture-frame feed-profile-picture-frame">
                        <img class="profile-picture" src="<?=$author_picture?>" alt="Profile picture">
                    </div>
                    <div class="feed-author-infos">
                    <div class="feed-author-name">
                        <p><?=$author_username?></p>
                    </div>
                    <div class="feed-time-info">
                        <p><?=$time_ago?></p>
                    </div>
                    </div> 
                </div>
            </a>
                <div class="feed-post-interactive-buttons">
                <form method="POST" action="/like"><button class="feed-post-button  <?=($loggedLiked) ? "feed-active" : "";?>">
                    <i class="fas fa-heart"></i>
                </button></form>
                <button class="feed-post-button">
                    <i class="fas fa-comment"></i>
                </button>
                <button class="feed-post-button">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="feed-post-description">
        <p><?=$description?></p>
    </div>
    <hr class="feed-post-divider">
</div>

<div class="post-comments-area">
    <?php foreach($comments as $comment): ?>
        <div class="post-comment">
            <div class="profile-picture-frame comment-profile-picture-frame">
                <img class="profile-picture" src="<?=$comment->getPic()?>" alt="Profile picture">
            </div>
            <div class="post-comment-content">
                <div class="post-comment-text">
                    <p><a href="/user/echo"><b>@<?=$comment->getUsername()?></b></a> <?=$comment->getText()?></p>
                </div>
                <div class="post-comment-time">
                    <p><?=$comment->getTimeAgo()?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>