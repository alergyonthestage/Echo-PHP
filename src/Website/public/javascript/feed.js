import Post from "./components/Post.js";

const feed = document.getElementById('feed')

const oneLoadPostNumber = 10

function loadPosts() {
    for(let $i = 0; $i < oneLoadPostNumber; $i++) {
        feed.innerHTML += new Post({
            cover_art: 'public/img/cover/1.png', 
            username: 'brtmnl', 
            profile_picture: 'public/img/profiles/3.png', 
            time_ago: '5 hours ago', 
            description: 'Wow che bella canzone!', 
            song_title: 'Brain in The Jelly - Alergy'
        }).render();
    }
}

loadPosts()