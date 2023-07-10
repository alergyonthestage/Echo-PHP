import Post from "./components/Post.js";

const feed = document.getElementById('feed')
const oneLoadPostNumber = 10

async function getPostData(postId) {
    let $response = await fetch(`/api/post/${postId}`, {
        method: "GET",
    })
    if($response.status === 200) {
        let $result = await $response.json()
        return $result 
    }
    return null
}

function loadPosts() {
    for(let i = 0; i < oneLoadPostNumber; i++) {
        getPostData(i)
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