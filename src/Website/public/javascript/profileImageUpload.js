const mime_types = [ 'image/jpeg', 'image/png' ];
const max_file_size = 5*1024*1024
const fileSelector = document.getElementById('fileSelector');

fileSelector.onchange = () => {
    uploadFile(getFile());
}

function getFile() {
    if(fileSelector.files.length == 0) {
        alert('select a file...')
        return
    }

    let file = fileSelector.files[0]

    if(!mime_types.includes(file.type)) {
        alert('non supported file format')
        return
    }

    if(file.size > max_file_size) {
        alert(`Please select file having less than ${max_file_size} size.`);
        return;
    }

    return file;
}

function uploadFile(file) {
    var form_data = new FormData();
    form_data.append('file', file);
    var request = new XMLHttpRequest();
    request.open('post', '/editprofile');
    request.send(form_data);
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText)
        }
    }
}