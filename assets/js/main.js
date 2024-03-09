var titleElement = document.querySelector('title');
var descriptionElement = document.querySelector('description');
var versionElement = document.querySelector('version');
var hloginElement = document.querySelector('hlogin');


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
        
        if (hloginElement) {
            hloginElement.innerText = jsonData.hlogin;
        }
    })
    .catch(error => console.error('Error fetching JSON:', error));
