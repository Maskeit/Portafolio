
const app = {
    urlDatos : "../Models/Noticias.php",
    noticias: [], //aqui almacenamos los datos

    // funcion para obtener los datos
    obtenerDatos: async function(){
        const contenido = $("#content");
        let html ="";
        fetch('../Models/Noticias.php')
        .then(response => response.json())
        .then(data => {
            const noticias = data; // Corregir la asignación a la propiedad noticias
            console.log(noticias);
            // Aquí puedes hacer cualquier cosa que necesites con los datos
            for(let post of noticias){ // Usar la propiedad noticias
                html +=`
                    <div class="card text-center">
                        <div class="card-header">
                            <h1>${ post.titulo }</h1>
                        </div>
                        <div class="card-body">
                        <img src="..." class="img-fluid" alt="...">
                            <p class="card-text">${post.extracto}</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                        <div class="card-footer text-muted">${post.fecha}</div>
                    </div>
                `;
                //el contenido se va llenar con contenido.innerHTML = html //metodo con el DOM
                //contenido.innerHTML = html
            }
            contenido.html(html); //metodo jquery
        })
        .catch(err => console.error(err)); 

    }
}
window.onload = function(){
    app.obtenerDatos();

}