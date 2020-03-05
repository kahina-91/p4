<?php
class Backend
{  
    
    public function adminIndex()
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
       
        $manager = new PostManager();
        $commtManag = new CommentManager();
        $allPosts = $manager->getAllPosts();
        $allComments = $commtManag->getAllComments();
        $flagComment = $commtManag->getFlagComment();
        require(VIEW.'backend/adminView.php');
        
    }

    public function disconnect()
    {
        
         session_destroy();
         header('Location: index.php');

    }

    public function deletePost() {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $manager = new PostManager();
        $manager->delete('posts', $_GET['id']);
         header('Location: index.php?action=adminIndex');

    }
    
    public function edit()
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $manager = new PostManager();
        $post = $manager->getPost($_GET['id']);
        require(VIEW.'backend/updateView.php');
       
    }
    public function update($title, $content, $postId)
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $manager = new PostManager();
        $update = $manager->updatePost($title, $content, $postId);
        header('Location: index.php?action=adminIndex');
    }
    
    public function creatPost()
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        require(VIEW.'backend/creatView.php');
    }

    public function insertPost($title, $content)
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $postManager = new PostManager();
        $createdPost = $postManager->creatPost($title, $content);
         if ($createdPost === true) {
            var_dump('post crée');
            header('Location: index.php?action=adminIndex');
        }
        else {
            var_dump('erreur depuis le backend');
            throw new Exception('Impossible d\'ajouter l\'article !');
            
            exit;
        }
    }
    public function annulflag($commentId)
    {
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $commentManager = new CommentManager();
        $flag = $commentManager->annulflag($commentId);
        header('Location: index.php?action=adminIndex');

    }
    public function deleteComment(){
        if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
        $manager = new CommentManager();
        $manager->delete('comments', $_GET['id']);

        header('Location: index.php?action=adminIndex');
         exit();
    }
}