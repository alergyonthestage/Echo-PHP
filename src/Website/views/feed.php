<div class="scroll-navigation">
   <button class="scroll-nav-button active">Feed</button>
   <button class="scroll-nav-button">Explore</button>
</div>
<div class="post-container">
<?php foreach ($data as $post): extract($post) ?>
<div class="post">
        <div class="post-header">
            <div class="covert-art">
                <div class="cover-square">
                    <img class="cover-disc" src="<?=$cover_art?>" alt="Cover-Art"/>
                    <button class="play-button"><i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="post-infos">
                <a href="/user/<?=$username?>">
                <div class="post-author-infos">
                    <img class="profile-picture" src="<?=$profile_picture?>" alt="Profile picture">
                    <div class="author-infos">
                        <div class="author-name">
                            <p><?=$username?></p>
                        </div>
                        <div class="time-info">
                            <p><?=$time_ago?></p>
                        </div>
                    </div> 
                </div>
                </a>
                <div class="post-song-infos">
                    <div class="post-song-title">
                        <p><?=$song_title?></p>
                    </div>
                    <div class="song-progress-bar">
                        <div class="song-progress-bar-inner"></div>
                    </div>
                    </div>
                    <div class="post-interactive-buttons">
                    <button class="post-button active">
                        <i class="fas fa-heart"></i>
                    </button>
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
<?php endforeach; ?>
   
</div>