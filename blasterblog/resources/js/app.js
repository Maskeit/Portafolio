const ruta = "/portafolio/blasterblog";
const app = {

    routes : {
        inisession : ruta + "/resources/views/auth/login.php",
        endsession :ruta + "/app/app.php?_logout",
        login : ruta +"/app/app.php",
        register : ruta + "/resources/views/auth/register.php",
        doregister : ruta + "/app/app.php",
        prevposts : ruta +"/app/app.php?_pp",
        lastpost : ruta +"/app/app.php?_lp",
        openpost : ruta +"/app/app.php?_op",
        newpost : ruta +"/resources/views/autores/newpost.php",
        myposts : ruta +"/resources/views/autores/myposts.php",
        postcomments : ruta+"/app/app.php?_pm",
        savecomment : ruta +"/app/app.php",
    },
    user : {
        sv : false,
        id : "",
        tipo : "",
    },
    pp : $("#prev-posts"),
    lp : $("#content"),

    view : function(route){
        location.replace(this.routes[route]);
    },
    previousPosts : function(){
        let html = `<b>Aún no hay publicaciones en este blog</b>`;
        this.pp.html("");
        fetch(this.routes.prevposts)
            .then( resp => resp.json())
            .then( ppresp => {
                if( ppresp.length > 0){
                    html = "";
                    let primera = true;
                    for( let post of ppresp ){
                        if(post.active == 1){
                            html += `
                                <a href="#" onclick="app.openPost(event,${ post.id },this)"
                                    class="list-group-item list-group-item-action ${ primera ? `active`:``} pplg">
                                    <div class="w-100 border-bottom ">
                                        <h5 class="mb-1">${ post.title }</h5>
                                        <small class="text-${ primera ? `light` : `muted` }">
                                            <i class="bi bi-calendar-week"></i> 
                                            ${ post.fecha }
                                        </small>
                                    </div>
                                    <small>
                                        <i class="bi bi-person-circle"></i>
                                        <b>${ post.name }</b>
                                    </small>
                                </a>
                            `;
                            primera = false;
                        }
                    }
                    this.pp.html(html);
                }
            }).catch( err => console.error( err ));

    },
    lastPost : function(limit){
        let html = "<h2>Aún no hay publicaciones</h2>";
        this.lp.html("");
        fetch(this.routes.lastpost + "&limit=" + limit)
            .then( response => response.json())
            .then( lpresp => {
                if( lpresp.length > 0 ){
                    html = this.postHTMLLoad(lpresp);
                }
                this.lp.html(html);
            }).catch( err => console.error( err ));
    },
    openPost : function(event,pid,element){
        event.preventDefault();
        $(".pplg").removeClass("active");
        element.classList.add("active");
        this.lp.html("");
        let html = "";
        fetch(this.routes.openpost + "&pid=" + pid)
            .then( response => response.json())
            .then( post => {
                //console.log(post[0]);
                html = this.postHTMLLoad(post);
                this.lp.html(html);
            }).catch( err => console.error( "Error al abrir la pulicación : ",err ));
    },
    postHTMLLoad : function(post){
        const imageUrl = "/images/" + post[0].thumb;
            return `
                    <div class="w-100 p-4 border-bottom bg-body rounded-3 shadow-lg">
                        <h5 class="mb-1">${ post[0].title }</h5>
                        <small class="text-muted">
                            <i class="bi bi-calendar-week"></i> ${ post[0].fecha } | 
                            <i class="bi bi-person-circle"></i> ${ post[0].name }
                        </small>
                        <img src="${imageUrl}" class="card-img-top" alt="...">
                        <p class="bm-1 border-bottom fs-3" style="text-align:justify;">
                            ${ post[0].body }
                        </p>
                        <i class="bi bi-hand-thumbs-up"></i> <span id="likes">${ 0 }</span>
                        <p class="float-end">
                            <span id="comentarios">
                                <a href="#" onclick="app.toggleComments(event,${post[0].id},'#post-comments')" 
                                    class="btn btn-link btn-sm text-decoration-none 
                                        ${ post[1].tt > 0 ? '' : 'disabled' } link-secondary" rol="button">
                                    <i class="bi bi-chat-right-dots"></i> 
                                    ver comentarios (${ post[1].tt })
                                </a>
                            </span>
                        </p>
                        <div class="input-group mb-3 border-bottom-0">
                            <input type="text" class="form-control rounded-pill btn-outline" ${ this.user.sv ? '' : ' disabled readonly '} 
                                placeholder="${ this.user.sv ? 'Escribe un comentario' : 'Regístrate para poder hacer comentarios' }" 
                                name="comment" id="comment"
                                aria-label="Recipient's username" 
                                aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-pill" ${ this.user.sv ? '' : ' disabled'} type="button" id="button-addon2" onclick="app.saveComment(${ post[0].id });">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                        <div class="container mb-2" fs-6>
                            <ul class="list-group d-none" id="post-comments">
                                <li></li>
                            </ul>
                        </div>
                    </div>
                `;
    },

    toggleComments(e, pid,element){
        const vercomment = document.querySelector('#post-comments');
        if(e){
            e.preventDefault();
            $(element).toggleClass("d-none");
        } else{
            vercomment.textContent = 'Cerrar comentarios';
            $(element).removeClass("d-none");
        }    
        fetch(this.routes.postcomments + "&pid=" + pid)
            .then( resp => resp.json() )
            .then( comments => {
                if(comments.length > 0){
                    let html = "";
                    for( let c of comments){
                        html += `
                            <li class="list-group-item mb-2 rounded-bottom">
                                <p class="fw-bold mb-0">${c.name}</p>
                                <p>${c.comment}</p>
                            </li>
                        `;
                    }
                    $(element).html(html);
                }
            }).catch( err => console.error("Hay un error: ",err));
    },

    saveComment(pid){
        if($("#comment").val() !== ""){
            const datos = new FormData();
            datos.append('pid',pid);
            datos.append("comment",$("#comment").val());
            datos.append('_sc',"");
            fetch(this.routes.savecomment,{
                method:"POST",
                body: datos
            }).then( () => {
                $("#comment").val("");
                this.toggleComments(null,pid,"#post-comments"); //no es un metodo, solo lo estoy llamando sin pasarle nada
            }).catch( err => console.error( "Hay un error: ", err));
        }
    }
}