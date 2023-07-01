export default class PostCreationForm {

    step = 0
    steps = [
        `<form>
            <input type="text" placeholder="Search"></input>
            <ul id="song-list">
                <li>Song 1</li>
                <li>Song 2</li>
            </ul>
        </form>`,
        `<form>
            <input type="text" placeholder="Search"></input>
        </form>`,
        `<form>
        </form>`

    ]

    nextStep() {
        if(this.step >= this.steps.length) {
            return 'Done';
        }
        return this.steps[this.step++]
    }

}