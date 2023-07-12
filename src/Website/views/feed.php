<view-head>
  <link rel="stylesheet" href="/public/css/components/post.css">
  <link rel="stylesheet" href="/public/css/components/avatar.css">
  <link rel="stylesheet" href="/public/css/components/buttons.css">
  <link rel="stylesheet" href="/public/css/views/feed.css">
<link rel="stylesheet" href="/public/css/components/loading.css">
  <script type="module" src="/public/javascript/feed.js"></script>
</view-head>
<div id="feed"></div>

<div class="loading-icon">
  <i class="fa-solid fa-compact-disc fa-spin"></i>
</div>
<script>
  var loadingIcon = document.querySelector('.loading-icon');

  window.addEventListener('beforeunload', function() {
    loadingIcon.style.display = 'none';
  });

  window.addEventListener('load', function() {
    loadingIcon.style.display = 'block';
    loadingIcon.classList.add('active');
  });
</script>

<a href="/publish" class="floating-add-button">
  <div class="fa-solid fa-plus fa-2xl"></div>
</a>

