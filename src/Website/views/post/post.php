<view-head>
    <link rel="stylesheet" href="/public/css/components/post.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/components/commentsSection.css">
    <link rel="stylesheet" href="/public/css/layout.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <script type="module" src="/public/javascript/post/post.js"></script>
</view-head>
<div id="post" post-id=<?=$id?>></div>
<div class="post-comments-area">
    <?php if(empty($comments)): ?>
        <div class="post-comment">
            <div class="post-comment-content">
                <div class="post-comment-text">
                    <p>No comments yet</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php foreach($comments as $comment): ?>
            <div class="post-comment">
                <div class="profile-picture-frame comment-profile-picture-frame">
                    <img class="profile-picture" src="<?=$comment->getAuthor()->getPic()?>" alt="Profile picture">
                </div>
                <div class="post-comment-content">
                    <div class="post-comment-text">
                        <p><a href="/user/<?=$comment->getAuthor()->getUsername()?>"><b>@<?=$comment->getAuthor()->getUsername()?></b></a> <?=$comment->getText()?></p>
                    </div>
                    <div class="post-comment-time">
                        <p><?=$comment->getTimeAgo()?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="post-footer">
    <form action="/comment/publish" method="POST">
        <input type="hidden" name="id_post" value="<?=$id?>">
        <input type="text" name="text" placeholder="Write a comment...">
        <button type="submit" class="post-comment-publish-button"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>
