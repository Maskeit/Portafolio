<?php

    namespace Controllers;

    use Models\posts;
    use Models\user;
    use Models\comments;
    use Controllers\auth\LoginController as LoginController;

    class PostController {

        private $userId;
        private $title;
        private $body;

        public function __construct(){
            $ua = new LoginController();
            $ua->sessionValidate();
            $this->userId = $ua->id;
        }
        
        public function getPosts($limit="",$pid = ""){
            $posts = new posts();
            $resultP = $posts->select(['a.id','a.title','a.body','a.thumb','a.active','date_format(a.created_at,"%d/%m/%Y") as fecha','b.name'])
                            ->join('user b','a.userId=b.id')//unimos los campos de dos tablas, el id del usuario en ambas tablas
                            ->where( $pid != "" ? [['a.id',$pid]] : [])
                            ->orderBy([['a.created_at','DESC']])
                            ->limit($limit)
                            ->get();
            if( $pid != "" || $limit == 1){
                $comments = new comments();
                $resultC = $comments->select(['id'])->count()
                                    ->where([['postId',json_decode($resultP)[0]->id]])
                                    ->get();
                $result = json_encode(array_merge(json_decode($resultP),json_decode($resultC)));
            }else{
                $result = $resultP;
            }
            return $result;
        }

        public function newPost($datos){
            $post = new posts();
            // Obtener la ruta relativa del archivo
            $rutaImagen = $datos['thumb']['tmp_name'];
            // Asignar la ruta de la imagen al campo 'thumb'
            $post->valores = [$datos['uid'], $datos['title'], $datos['body'], $rutaImagen];

            $result =$post->create();
            return;
            die;
        }

        public function getMyPosts($uid){
            $posts = new posts();
            $result = $posts->where([['userId',$this->userId]])->get();
            return $result;               
        }
        
        public function countPostComments($pid){
            $comments = new comments();
            $result = $comments->count()->where([['postId',$pid]])->get();
            return $result;
        }

        public function togglePostActive($pid){
            $post = new posts();    
            $result = $post->where([['id',$pid]])->update([['active','not active']]);
        }

        public function deletePost($pid){
            $post = new posts();
            $result = $post->delete($pid);
            return $result;
            die;
        }
        
        public function update($datos){
            $post = new posts();//se crea una instancia  del modelo posts
            $post->valores = [$datos['uid'], $datos['title'], $datos['body']]; //se le asignan los valores a la variable valores[] del modelo
            $result = $post->update($datos['pid']); //Se invoca el método update del modelo posts pasando como argumento el pid
            return $result;
        }
        
        public function getPostComments($pid){
            $comment = new comments();
            //a la variable return le asignamos las consultas para obtener el comentario correspondiente
            $result = $comment->select(['name','comment']) //select: a este array le pasamos los datos que queremos traer
                                ->where([['postId',$pid]]) // where : buscamos mediante su id
                                ->orderBy([['created_at','DESC']])// orderBY : ordenamos de mas reciente al mas viejo
                                ->get(); //get : obtenemos los resultados
            return $result;
        }

        public function saveComment($datos){
            $comment = new comments();
            $user = new user();
            $u = $user->select(['name','email'])
                        ->where((['id',$this->userId]))
                        ->get();
            $u = json_decode($u);
            $comment->valores = [$datos['pid'], 
                                    $u[0]->name, 
                                    $u[0]->email, 
                                    $datos['comment']
                                ];
            print_r($comment->create());

        }
    }