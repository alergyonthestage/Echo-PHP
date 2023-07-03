import Post from './Post.js';

class Feed extends HTMLElement {

    constructor() {
        super();
        this.render(10);
        this.isScrolling = false;
        this.detectScrollToBottom();
    }

    render($initialPostsNumber) {
        this.innerHTML += '<div class="feed-post-container">';
        for(let $i = 0; $i < $initialPostsNumber; $i++) {
            this.innerHTML += new Post({cover_art: 'public/img/cover/1.png', username: 'brtmnl', profile_picture: 'public/img/profiles/3.png', time_ago: '5 hours ago', description: 'Wow che bella canzone!', song_title: 'Brain in The Jelly - Alergy'}).render();
        }
        this.innerHTML += '</div>';
    }

    detectScrollToBottom() {
        window.addEventListener('scroll', () => {
        const scrollPosition = window.pageYOffset;
        const windowSize = window.innerHeight;
        const bodyHeight = document.body.offsetHeight;
        const feedPostContainer = this.querySelector('.feed-post-container');
        const lastPost = feedPostContainer.lastElementChild;
    
        if (scrollPosition + windowSize >= bodyHeight && !this.isScrolling && lastPost) {
          const lastPostOffset = lastPost.offsetTop + lastPost.offsetHeight;
          if (lastPostOffset <= scrollPosition + windowSize) {
            this.isScrolling = true;
            this.render(1);
            this.isScrolling = false;
          }
        }
        });
    }

}

customElements.define('echo-feed', Feed);