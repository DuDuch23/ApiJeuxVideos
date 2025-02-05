const token = localStorage.getItem('jwt_token');  // Récupère le token depuis LocalStorage
fetch('https://127.0.0.1:8000/api/videogame', {
    method: 'GET',
    headers: {
        'Authorization': `Bearer ${token}`
    }
})
.then(response => response.json())
.then(data => console.log(data));