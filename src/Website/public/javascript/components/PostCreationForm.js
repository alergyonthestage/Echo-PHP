export default class PostCreationForm {

    step = 0
    steps = [
        `<form action="none">
            <input type="text" placeholder="Search"></input>
            <ul id="song-list">
                <li>Song 1</li>
                <li>Song 2</li>
            </ul>
            <button id="next-button" type="button">Next</button>
        </form>`,
        `<form>
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Tell something about this song"></input>
            <button id="next-button" type="button">Next</button>
        </form>`,
        `<form>
            Is it ok?
            <button id="next-button" type="button">Post</button>
        </form>`

    ]

    hasNext() {
        return this.step < this.steps.length
    }

    nextStep() {
        if(!this.hasNext()) {
            return this.steps[this.steps.length-1]
        }
        return this.steps[this.step++]
    }

}