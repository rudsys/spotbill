var titleElement = document.querySelector('title');
var descriptionElement = document.querySelector('#description'); // Ganti '#description' dengan selector yang sesuai
var versionElement = document.querySelector('#version'); // Ganti '#version' dengan selector yang sesuai


fetch('../../config/app.json')
    .then(response => response.json())
    .then(jsonData => {

        titleElement.innerText = jsonData.title;

        if (descriptionElement) {
            descriptionElement.innerText = jsonData.description;
        }

        if (versionElement) {
            versionElement.innerText = jsonData.version;
        }
    })
    .catch(error => console.error('Error fetching JSON:', error));
