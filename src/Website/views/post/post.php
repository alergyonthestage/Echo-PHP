<view-head>
    <link rel="stylesheet" href="/public/css/components/post.css">
</view-head>
<div class="post">
    <div class="post-covert-art">
        <div class="post-cover-square">
            <img class="post-cover-disc" src="<?=$cover_art?>" alt="Cover-Art"/>
            <button class="post-play-button"><i class="fas fa-play"></i></button>
        </div>
    </div>
    <div class="post-infos">
        <div class="post-song-infos">
            <div class="post-song-title">
                <p><?=$song_info?></p>
            </div>
            <div class="post-song-progress-bar">
                <div class="post-song-progress-bar-inner"></div>
            </div>
        </div>
        <div class="post-header">
            <a href="/user/<?=$author_username?>">
                <div class="post-author-infos">
                    <div class="profile-picture-frame post-profile-picture-frame">
                        <img class="profile-picture" src="<?=$author_picture?>" alt="Profile picture">
                    </div>
                    <div class="post-author-infos">
                    <div class="post-author-name">
                        <p><?=$author_username?></p>
                    </div>
                    <div class="post-time-info">
                        <p><?=$time_ago?></p>
                    </div>
                    </div> 
                </div>
            </a>
                <div class="post-interactive-buttons">
                <form method="POST" action="/like"><button class="post-button  <?=($loggedLiked) ? "post-active" : "";?>">
                    <input type="hidden" name="id_post" value="<?=$id_post?>">
                    <i class="fas fa-heart"></i>
                </button></form>
                <button class="post-button">
                    <i class="fas fa-comment"></i>
                </button>
                <button class="post-button">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="post-description">
        <p><?=$description?></p>
    </div>
    <hr class="post-divider">
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
<div class="post-footer">
    <form action="/comment/publish" method="POST">
        <input type="hidden" name="id_post" value="<?=$id_post?>">
        <input type="text" name="text" placeholder="Write a comment...">
        <button type="submit" class="post-comment-publish-button"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>
