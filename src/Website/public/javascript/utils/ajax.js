async function fetchData(link) {
    try {
        let response = await fetch(link, {
            method: "GET"
        })
        return await response.json()
    } catch (error) {
        console.error("Fetch error: ", error);
    }   
}

async function uploadFormData(link, formData) {
    try {
      const response = await fetch(link, {
        method: "POST",
        body: formData
      });
      return await response.json()
    } catch (error) {
      console.error("Fetch error: ", error);
    }
}

export { fetchData, uploadFormData };