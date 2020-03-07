<?php

class Routeur{
	private $front;
	private $back;
	public function __construct()
	{
		$this->front = new Frontend();
		$this->back = new Backend();
	}
	public function route()
	{
		(isset($_GET['action'])) ? $action = $_GET['action'] : $action = "listPosts" ;

		try 
		{
			
			switch($action) {
				case 'listPosts':
					$this->front->listPosts();
					break;
				
				case 'connect':
					$this->front->connect();
					break;

				case 'allPosts':
					$this->front->allPosts();
					break;

				case 'login':
					if(isset($_POST) AND !empty($_POST))
						{
							if (!empty(htmlspecialchars($_POST['username'])) && !empty(htmlspecialchars($_POST['password'])))
						    {
						    	$this->front->login($_POST['username'], sha1($_POST['password']));
						    }else
						    {
						    	throw new Exception("remplissez les champs");
						    	
						    }		    
						}
				    else
				    {
                    	echo "Vous n'etes pas autorisé c'est l'espace réservé à l'admin du site";
		            }
					
					break;
                case 'adminIndex':
					$this->back->adminIndex();
					break;
				case 'disconnect':
					$this->back->disconnect();
					break;

				case 'auteur':
					$this->front->auteur();
					break;
                
                case 'edit':
                    if (isset($_GET['id']) && $_GET['id'] > 0) 
                    {
                    	$this->back->edit();
                    }
					
					break;
                
                case 'post':
					$this->front->post();
					break;

                case 'pagin':
                
                	$this->front->pagin();
                    break;
				case 'update':
				    $this->back->update($_POST['title'], $_POST['content'], $_GET['id']);
					break;
				case 'delete':
					$this->back->deletePost();
					break;
                
                case 'deleteComment':
					$this->back->deleteComment();
					break;

				case 'creatPost':
					$this->back->creatPost();
					break;
				case 'insertPost':   
					if (!empty($_POST['title']) && !empty($_POST['content'])) 
					{
						$this->back->insertPost($_POST['title'], $_POST['content']);
						var_dump("l'article as bien été ajouté");
					
				    }else {
				    	
	                    throw new Exception("impossible d'ajouter l'article !");
	                }
		       	    
					break;
				case 'addComment':
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
		                {
		                    $this->front->addComment($_GET['id'], $_POST['author'], $_POST['comment'], '0');
		                }
		                else {
		                    throw new Exception('Tous les champs ne sont pas remplis !');
		                }
		            }
		            else {
		                throw new Exception('Aucun identifiant de billet envoyé');
		            }
		            break;
		        case 'flagComment': 

					$this->front->flagComment($_GET['commentId']);

					break;
				case 'annulflag':
					$this->back->annulflag($_GET['commentId']);
					break;
				default:
					echo "erreur 404";
			}
		}

		catch(Exception $e)
		{
			echo 'Erreur: ' . $e->getMessage();
		}

	} 
}