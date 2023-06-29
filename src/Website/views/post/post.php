<view-head>
    <link rel="stylesheet" href="/public/css/views/feedStyle.css">
</view-head>
<div class="feed-post">
        <div class="feed-post-header">
            <div class="feed-covert-art">
                <div class="feed-cover-square">
                    <img class="feed-cover-disc" src="<?=$cover_art?>" alt="Cover-Art"/>
                    <button class="feed-play-button"><i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="feed-post-infos">
                <a href="/user/<?=$author_username?>">
                <div class="feed-post-author-infos">
                    <div class="profile-picture-frame feed-profile-picture-frame">
                        <img class="profile-picture" src="<?=$author_picture?>" alt="Profile picture">
                    </div>
                    <div class="feed-author-infos">
                        <div class="feed-author-name">
                            <p><?=$author_username?> <?php if($author_verified) {echo '<i class="fas fa-check-circle" title="Profilo verificato"></i>';}?></p>
                        </div>
                        <div class="feed-time-info">
                            <p><?=$time_ago?></p>
                        </div>
                    </div> 
                </div>
                </a>
                <div class="feed-post-song-infos">
                    <div class="feed-post-song-title">
                        <p><?=$song_info?></p>
                    </div>
                    <div class="feed-song-progress-bar">
                        <div class="feed-song-progress-bar-inner"></div>
                    </div>
                    </div>
                    <div class="feed-post-interactive-buttons">
                    <button class="feed-post-button feed-active">
                        <i class="fas fa-heart"></i>
                    </button>
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