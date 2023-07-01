import Post from './Post.js';

class Feed extends HTMLElement {

    constructor() {
        super();
        this.render(10);
    }

    render($initialPostsNumber) {
        for(let $i = 0; $i < $initialPostsNumber; $i++) {
            this.innerHTML += new Post({title: 'Post '+$i}).render();
        }
    }

}

customElements.define('echo-feed', Feed);