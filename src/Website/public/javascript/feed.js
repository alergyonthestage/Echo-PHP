import Post from "./components/Post.js";
import { fetchData } from "./utils/ajax.js";

const feed = document.getElementById('feed')
const oneLoadPostNumber = 10

function loadPosts() {
    for(let i = 0; i < oneLoadPostNumber; i++) {
        fetchData(`/api/post/${i}`)
            .then((data) => {
                if(data !== null) {
                   feed.innerHTML += new Post(data).render() 
                }
            })
            .catch((error) => {
                feed.innerHTML += `Error: ${error}`
            })
    }
}

loadPosts()