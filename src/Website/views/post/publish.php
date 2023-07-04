<view-head>
    <link rel="stylesheet" href="/public/css/views/createPost.css">
    <script defer src="/public/javascript/createPost.js"></script>
</view-head>
<h1 class="title">Create post</h1>
<div class="create-post-progress-bar">
    <div class="create-post-steps">
        <a>Search</a>
        <a>Details</a>
        <a>Review</a>
    </div>
</div>
<form action="/publish" method="post" multi-step-form>
    <div class="create-form-step" form-step>
        <input type="text" placeholder="Search"></input>
        <ul id="song-list">
            <li>Song 1</li>
            <li>Song 2</li>
        </ul>
        <button type="button" next-step>Next</button>
    </div>
    <div class="create-form-step" form-step>
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Tell something about this song"></input>
        <button type="button" next-step>Next</button>        
    </div>
    <div class="create-form-step" form-step>
        Is it ok?
        <input type="submit" value="Publish">
    </div>
</form>