const mime_types = [ 'image/jpeg', 'image/png' ];
const max_file_size = 5*1024*1024
const fileSelector = document.getElementById('file-selector');

const apiLink = "/api/avatar";

function getFile() {
    if(fileSelector.files.length == 0) {
        console.log('No file selected')
        return
    }
    let file = fileSelector.files[0]
    if(!mime_types.includes(file.type)) {
        console.log('non supported file format')
        return
    }
    if(file.size > max_file_size) {
        console.log(`Please select file having less than ${max_file_size} size.`);
        return
    }
    return file;
}

async function uploadFormData(link, formData) {
    try {
      const response = await fetch(link, {
        method: "POST",
        body: formData
      });
      const result = await response.text()
      console.log(result);
    } catch (error) {
      console.error("Error:", error);
    }
}

fileSelector.onchange = () => {
    let photo = getFile();
    if(photo !== null) {
        const formData = new FormData();
        formData.append("avatar", photo);
        uploadFormData(apiLink, formData);
    }
}