const app_myposts = {

    url : "/portafolio/blasterblog/app/app.php",

    mp : $("#my-posts"),
    dp : $("#deletePost"),
    vp : $("#verPost"),
    ep : $("#edPost"),
    alp : $("#all-posts"),
    postsData : [],

    getMyPosts : function(uid){
        let html = `<tr><td colspan="3">Aún no tiene publicaciones</td></tr>`;
        this.mp.html("");
        fetch(this.url + "?_mp&uid=" + uid)
            .then( resp => resp.json())
            .then( mpresp => {
                if( mpresp.length > 0 ){
                    html = "";
                    for( let post of mpresp ){
                      const activeIcon = post.active === "1" ? "bi-toggle-on" : "bi-toggle-off";
                        html += `
                                  <tr>
                                    <td>${post.title}</td>
                                    <td>${new Date().toDateString(post.created_at)}</td>
                                    <td>
                                        <a href="#" class="link-primary" id="verPost" onclick="app_myposts.verPost(${post.id})"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="link-primary mx-2" id="edPost" onclick="app_myposts.editarPost(${post.id})"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" class="link-success" 
                                          tabindex="0" data-bs-trigger="hover focus" 
                                          data-bs-content="Desactivar publicacion" 
                                          onclick="app_myposts.togglePostActive(${post.id})">
                                          <i class="bi ${activeIcon}"></i>
                                        </a>
                                        <a href="#" class="link-secondary mx-2" id="deletePost" onclick="app_myposts.deletePost(${post.id})"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>`;
                    }
                }
                this.mp.html(html);
            }).catch( err => console.error( err ));
    },
    togglePostActive : function(pid,uid){ //tpa =togglepostactive
        fetch(this.url + "?_tpa&pid=" + pid)
            .then( resp => {
                if(resp.ok){
                  //alert("Se ha actualizado el estado de la publicacion.");
                  this.getMyPosts(uid);
                }
            }).catch(err => console.error("Hay un error :",err));
        
    },
    deletePost: function(pid) {
        const confirmDelete = confirm("¿Desea eliminar la publicación? Se eliminarán los comentarios relacionados");
        if (confirmDelete) {
            //aqui se envia la peticion al post que controla las publicaciones y usa la funcion deletePost que debe eliminar el post usando el metodo correspondiente
            fetch(this.url + "?_dp&pid=" + pid)
                .then(resp => resp.json());
            alert("se ha borrado la publicacion");
        } else{
            alert("No se pudo borrar la publicacion, intentelo de nuevo");
        }
    },
    verPost: function(pid) {
    // elimina cualquier modal existente se supone
    $('#modal').remove();
      fetch(this.url + "?_vp&pid=" + pid)
        .then(resp => resp.json())
        .then(mpresp => {
          const post = mpresp[0]; // Obtener los datos de la publicación
          // Construir el HTML del modal con los datos del post
          let postActivo = "";
          let activeClass = "";
          if(post.active == 0){
            postActivo ="Esta publicacion no esta activa."
            activeClass = "secondary";
          } else if(post.active == 1){
            postActivo = "Esta publicacin esta activa.";
            activeClass = "success";
          }
          let modalHTML = `
          <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">${post.title}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>${post.body}</p>
                  <p class ="list-group-item list-group-item-${activeClass}">${postActivo}</p>
                </div>
              </div>
            </div>
          </div>
          `;
    
          // Agregar el modal al final del cuerpo del documento
          $('body').append(modalHTML);
    
          // Mostrar el modal
          $('.modal').modal('show');
        })
        .catch(err => console.error(err));
    },       
    editarPost: function(pid) {
      fetch(this.url + "?_vp&pid=" + pid)
      .then(resp => resp.json())
      .then(mpresp => {
        const post = mpresp[0]; // Obtener los datos de la publicación
  
        let modalHTML = `
          <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Editar: ${post.title}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="titulo">Título</label>
                    <textarea class="form-control" id="body">${post.title}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body">${post.body}</textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="app_myposts.actualizarPost(${pid})">Guardar cambios</button>
                </div>
              </div>
            </div>
          </div>
        `;
        // Agregar el modal al final del cuerpo del documento
        $('body').append(modalHTML);

        // Mostrar el modal
        $('.modal').modal('show');
      })
      .catch(err => console.error(err));
        
    },
    actualizarPost: function(pid) {
      // Obtener los datos del formulario
      const titulo = $('#titulo').val();
      const body = $('#body').val();
    
      // Crear el objeto de datos para enviar al backend
      const data = {
        pid: pid,
        titulo: titulo,
        body: body
      };
    
      // Realizar la solicitud POST al backend para actualizar el post
      fetch(this.url, {
        method: 'POST',
        body: JSON.stringify(data)
      })
      .then(resp => resp.json())
      .then(response => {
        // Comprobar la respuesta del backend y realizar las acciones necesarias
        if (response.success) {
          // Actualización exitosa
          // Puedes realizar alguna acción adicional aquí, como mostrar un mensaje de éxito o actualizar la vista de los posts
          alert("Publicacion actualizada con exito!");
          // Cerrar el modal
          $('.modal').modal('hide');
        } else {
          // Error en la actualización
          // Puedes mostrar un mensaje de error o realizar alguna acción adicional
          alert("No se actualizo correctamente");
          console.error('Error al actualizar el post');
        }
      })
      .catch(err => console.error(err));
    },
    
      
};