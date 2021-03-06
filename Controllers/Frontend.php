<?php 

class Frontend extends Controller 
{
    
    public function listPosts() 
    {

        $manager = new PostManager();
        $posts = $manager->getPosts();
        require(VIEW.'frontend/listPostsView.php');
    }
    
    public function allPosts()
    {
        
        $ma = new PostManager();
        $allPosts = $ma->getAllPosts();
        $all = $allPosts;

        require(VIEW.'frontend/AllPosts.php');
        
    }
   
   public function pagin()
   {  
        $session = $this->session;
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $manager = new PostManager();
            $posts = $manager->getAllPosts()->fetchAll();
            $po = count($posts);

            $commentManag = new CommentManager();
        
            if (isset($_GET['direction']))
            {
                $direction = $_GET['direction'];
            }else
            {
                $direction = null; 
            } 

            $post = $manager->getPost($_GET['id'], $direction);

            $comments = $commentManag->getComments($_GET['id']);
            
            require(VIEW.'frontend/postView.php');
        }else{
            echo 'Erreur : aucun identifiant de billet envoyé';
                
       }
   }

    public function connect()
    {
        require (VIEW.'backend/adminLoginView.php');
    }
    public function login($username, $password)
    {

        $loginManager = new LoginManager();
        $login = $loginManager->getUser($username, $password);

        if($login)
        {
            $_SESSION['admin']= $_POST['username'];
             header('Location: index.php?action=adminIndex');
        }    
        else
        {
            throw new Exception("Le nom ou le mot de passe est incorect");
            
        }    

    }
    public function addComment($postId, $author, $comment, $flag)
    {
        $mod = new CommentManager();
        $affectedLines = $mod->addComment($postId, $author, $comment, $flag);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            $this->session->setFlash('Commentaire publié!');
            header('Location: index.php?action=pagin&id='. $postId);
        }

    }
    public function flagComment($commentId)
    {
        $commentManager = new CommentManager();
        $flag = $commentManager->flagComment($commentId);
        $this->session->setFlash('Le commentaire est signalé');
        header("Location: index.php?action=pagin&id=" .$_GET['postId']);

    }
    public function auteur()
    {

        require(VIEW.'frontend/Auteur.php');
    }
     
     
}
