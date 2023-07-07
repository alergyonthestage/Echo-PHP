<view-head>
    <link rel="stylesheet" href="/public/css/components/post.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/layout.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <script type="module" src="/public/javascript/post.js"></script>
    <script type="module" src="/public/javascript/postInteractions.js"></script>
</view-head>
<div id="post" post-id=<?=$id_post?>></div>
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
