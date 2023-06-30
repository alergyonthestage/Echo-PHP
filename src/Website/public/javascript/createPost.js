$publishPostButton = document.getElementById('create-post-button');

$publishPostButton.onclick = () => {
    document.getElementsByTagName('main').item(0).innerHTML = `
        <h1>Create post</h1>
        <div>
            <form>
                <input type="text" placeholder="Search"></input>
            </form>
        </div>
    `;
}