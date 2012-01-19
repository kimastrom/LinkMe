<?php
Doo::loadController('CoreController');
class LinkController extends CoreController
{
    const GET_EDIT = 'edit';
    const GET_DELETE = 'delete';
    
    public function beforeRun($resource, $action)
    {
        parent::beforeRun($resource, $action);
        $this->login();
        $this->vote();
        $this->data[self::MENU_LINK_URL] = $this->buildLinkURL();
    }

    public function vote()
    {
        if ($this->isLoggedIn()) {

            if (!empty($_GET['vote']) && !empty($_GET['id'])) {
                $vote = $_GET['vote'];
                $link = $_GET['id'];
                Doo::loadModel('Link_rating');
                $lr = new Link_rating();
                $lr->doVote($vote, $link);
            }

        }
    }

    public function singleView()
    {
        $a = $this->vote();
        $id = $this->params['id'];
        if ($this->doesLinkExist($id)) {
            //Get link by id
            Doo::loadModel('Link');
            $link = new Link();
            $link->id = $id;
            $l = $link->getOne();

            $this->data['link'] = $l;
            $this->data[self::PAGE_TITLE] = $l->description;

            if ($this->isLoggedIn()) {
                if ($this->isPost()) {
                    $v = new DooValidator();
                    $error = $v->validate($_POST, 'add-comment-rules');
                    $this->data[self::ERRORS] = $error;

                    Doo::loadModel('Comment');
                    $comment = new Comment();
                    
                    //Add comment
                    if (empty($error) && $_POST['comment-button'] == 'kommentera') {
                        $comment->comment = strip_tags($_POST['comment']);
                        $comment->author_id = $this->session->get('id');
                        $comment->link_id = $id;
                        $comment->insert();

                    //Edit Comment
                    } else if (empty($error) && $_POST['comment-button'] == 'editera') {
                        $comment->id = $_POST['id'];
                        $comment = $comment->getOne();
                        if ($comment->isOwner()) {
                            $comment->comment = $_POST['comment'];
                            $comment->update();
                        }
                    }
                }

                //Ta bort kommentar
                if (isset($_GET[self::GET_DELETE])) {
                    Doo::loadModel('Comment');
                    $comment = new Comment();
                    $comment->id = $_GET[self::GET_DELETE];
                    $comment->delete();
                    
                //Editera en kommentar    
                } else if (isset($_GET[self::GET_EDIT])) {
                    Doo::loadModel('Comment');
                    $comment = new Comment();
                    $comment->id = $_GET[self::GET_EDIT];
                    $comment = $comment->find(array('limit' => 1));
                    $this->data['comment-text'] = $comment->comment;
                    $this->data['edit-id'] = $_GET['edit'];
                    $this->data['isEdit'] = true;
                }
            }
            //Get comments for the link
            Doo::loadModel('Comment');
            $comments = new Comment();
            $comments->link_id = $id;
            $this->data['comments'] = $comments->find(array('where' => "link_id=$id", 'asc' => 'date'));
            $this->render('singe-link', $this->data, true);
        } else {
            return 404;
        }

    }

    public function doesLinkExist($id)
    {
        Doo::loadModel('Link');
        $link = new Link();
        $link->id = $id;
        //if Link id doesn't exist, return an error
        if ($link->find(array('limit' => 1, 'where' => "id=$id")) == Null) {
            return false;
        }
        return true;
    }

    public function showLinks()
    {

        Doo::loadModel('Link');
        Doo::loadModel('Category');

        //Delete Links
        Doo::loadModel('Link');
        if ($this->isLoggedIn()) {
            if (isset($_GET[self::GET_DELETE])) {
                $id = $_GET[self::GET_DELETE];

                $link = new Link();
                $link->id = $id;

                $comments = Doo::loadModel('Comment', true);
                $comments->delete(array('where' => "link_id=$id"));

                $ratings = Doo::loadModel('Link_rating', true);
                $ratings->delete(array('where' => "link_id=$id"));

                $link->delete();
            }
        }

        //hämta länkar efter kategori
        $l = new Link();
        $opt = array();
        if (isset($this->params['category'])) {
            Doo::loadModel('Category');
            $category = new Category();
            $category->category = $this->params['category'];
            $category = $category->getOne();

            //Ifall categori inte existerar
            if (!isset($category->id)) {
                return 404;
            } else {
                $l->category_id = $category->id;
            }
        }

        //Hämtar länkar efter sortering
        if (isset($this->params['sort'])) {
            switch ($this->params['sort']) {
                case 'new' :
                    $opt = array('desc' => 'date');
                    $links = $l->find($opt);
                    break;
                case 'commented' :
                    $links = $l->mostComments();
                    break;
                case 'hot' :
                    $links = $l->highestRate();
                    break;
            }
        } else {
            $opt = array('desc' => 'date');
            $links = $l->find($opt);
        }

        $this->data['links'] = $links;
        $this->data[self::PAGE_TITLE] = 'Start';

        $this->render('start', $this->data);
    }

    public function addlink()
    {
        if ($this->isLoggedIn()) {
            if ($this->isPost()) {
                
                //validera formulärdatan
                $v = new DooValidator();
                $error = $v->validate($_POST, 'add-link-rules');
                $this->data[self::ERRORS] = $error;

                if (empty($error)) {
                    Doo::loadModel('Link');
                    $link = new Link();
                    $link->category_id = $_POST['categories'];
                    $link->url = $_POST['url'];
                    $link->description = $_POST['description'];
                    $link->user_id = $this->session->get('id');
                    $id = $link->insert();
                    DooUriRouter::redirect('comments/' . $id);
                }
            }
            $this->render('addlink', $this->data);
        } else {

            $this->render('not-authorized', $this->data);
        }

    }

}
