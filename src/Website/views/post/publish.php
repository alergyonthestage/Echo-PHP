<view-head>
    <link rel="stylesheet" href="/public/css/views/publish.css">
    <script type="module" src="/public/javascript/publish.js"></script>
</view-head>
<h1 class="title">Create post</h1>
<div class="publish-progress-bar">
    <div class="publish-steps">
        <a>Search</a>
        <a>Details</a>
        <a>Review</a>
    </div>
</div>
<form action="/publish" method="post" multi-step-form>
    <div class="publish-form-step" form-step>
        <input type="text" placeholder="Search a song" id="publish-song-search-field" name="song_id"></input>
        <ul id="publish-song-list">
        </ul>
    </div>
    <div class="publish-form-step" form-step>
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Tell something about this song"></input>
        <div>
            <input type="checkbox" name="share_only_friends" id="share_only_friends">
            <label for="share_only_friends">Share only with friends</label>
        </div>
        <button type="button" next-step>Next</button>        
    </div>
    <div class="publish-form-step" form-step>
        <div id="publish-post-preview"></div>
        <input type="submit" value="Publish">
    </div>
</form>