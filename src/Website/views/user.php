<div>
    <div id="profile-header">
        <div id="profile-picture-container">
           <img id="profile-picture" src="/public/img/profiles/alergyonthestage.png" alt="Profile picture">
        </div>
        <div id="user-side-infos">
            <div class="important-text" id="username">
                <?=$username?>
            </div>
            <div id="user-stats">
                <div class="stat">
                    <div>
                        <?=$echoes?>
                    </div>
                    <div class="secondary-text">
                        Echoes
                    </div>
                </div>
                <div class="stat">
                    <div>
                        <?=$posts?>
                    </div>
                    <div class="secondary-text">
                        Posts
                    </div>
                </div>
                <div class="stat">
                    <div>
                        <?=$friends?>
                    </div>
                    <div class="secondary-text">
                        Friends
                    </div>
                </div>
            </div>
            <button id="add-friend-button">Add</button>
        </div>
    </div>
    <div id="bio-section">    
        <div class="important-text"><?=$name?></div>
        <div id="biography" class="secondary-text"><?=$biography?></div>
    </div>
</div>