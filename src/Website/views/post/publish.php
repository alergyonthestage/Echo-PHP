<view-head>
    <link rel="stylesheet" href="/public/css/views/publish.css">
    <link rel="stylesheet" href="/public/css/components/buttons.css">
    <link rel="stylesheet" href="/public/css/components/post.css">
    <link rel="stylesheet" href="/public/css/components/avatar.css">
    <link rel="stylesheet" href="/public/css/utils.css">
    <link rel="stylesheet" href="/public/css/components/loadingDisc.css">
    <script type="module" src="/public/javascript/post/publish.js"></script>
</view-head>
<h1 class="title">Create post</h1>
<div class="publish-progress-bar">
    <div class="publish-steps">
        <a progress-bar-step>Search</a>
        <a progress-bar-step>Details</a>
        <a progress-bar-step>Review</a>
    </div>
</div>
<form action="/publish" method="post" multi-step-form>
    <div class="publish-form-step" form-step>
        <input type="text" placeholder="Search a song" id="publish-song-search-field" name="song-id"></input>
        <ul id="publish-song-list">
        </ul>
    </div>
    <div class="publish-form-step" form-step>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="10" placeholder="Tell something about this song"></textarea>
        <div>
            <button type="button" class="secondary-button" prev-step>Back</button>
            <button type="button" class="primary-button" next-step>Next</button>
        </div>        
    </div>
    <div class="publish-form-step" form-step>
        <div id="publish-post-preview"></div>
        <div>
            <button type="button" class="secondary-button" prev-step>Back</button>
            <input type="submit" class="primary-button button-action-text" value="Publish">
        </div> 
        
    </div>
</form>