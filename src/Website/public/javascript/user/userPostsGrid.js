import { fetchData } from "../utils/ajax.js";
import PostInsideGrid from "../components/PostInsideGrid.js";

const postsGrid = document.getElementById('user-profile-posts-grid')
postsGrid.innerHTML = "Loading..."
const userID = postsGrid.getAttribute('user')
const apiLink = `/api/post/user/`

loadPosts(userID);

function loadPosts(userID) {
    fetchData(apiLink+userID)
        .then(async (posts) => {
            if(posts.length > 0) {
                postsGrid.innerHTML = ""
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
                posts.forEach((postData) => {
                    postsGrid.innerHTML += new PostInsideGrid(postData).render()
                })
            } else {
                postsGrid.innerHTML = `<p>No posts yet.</p>`
            }
        })
        .catch(async (error) => {
            console.log(error)
        })
        .finally(() => {
        })
}