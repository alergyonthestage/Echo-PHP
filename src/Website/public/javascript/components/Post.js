export default class Post {

    constructor($data) {
        this.data = $data;
    }

    render() {
        return `
        <div>
            <h2>${this.data.title}</h2>
        </div>
        `
    }

}