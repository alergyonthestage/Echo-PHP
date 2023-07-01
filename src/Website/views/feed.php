<view-head>
    <link rel="stylesheet" href="/public/css/views/feedStyle.css">
    <script type="module" src="/public/javascript/components/Feed.js"></script>
</view-head>
<div class="feed-scroll-navigation">
   <button class="feed-scroll-nav-button feed-active">Feed</button>
   <button class="feed-scroll-nav-button">Explore</button>
</div>
<echo-feed></echo-feed>
<a href="/create" class="floating-add-button"><div class="fa-solid fa-plus fa-2xl"></div></a>