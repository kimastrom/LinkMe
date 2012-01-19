<?php
Doo::loadModel('base/CommentBase');

class Comment extends CommentBase
{
    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $author_id;

    /**
     * @var varchar Max length is 500.
     */
    public $comment;

    /**
     * @var timestamp
     */
    public $date;

    /**
     * @var int Max length is 11.
     */
    public $link_id;
    
    /**
     * @var string author name.
     */
    public $author;
    
    /**
     * @var boolean
     */
    public $isOwner;

    public $_table = 'comment';
    public $_primarykey = 'id';
    public $_fields = array('id', 'author_id', 'comment', 'date', 'link_id');

    public function __construct($data = null)
    {
        parent::__construct($data);
        parent::setupModel(__CLASS__);
        
        if(isset($this->id)) {
            $this->author = $this->getAuthor();
            $this->isOwner = $this->isOwner();
        }
    }

    /**
     * Check if logged in user is owner of this comment
     */
    public function isOwner()
    {
        $session = Doo::session("LinkMe");
        if ($session->get('id') == $this->author_id) {
            return true;
        }
        return false;
    }

    /**
     * get author name from User model
     */
    public function getAuthor()
    {
        Doo::loadModel('User');
        $user = new User();
        $user->id = $this->author_id;
        $user = $user->getOne();
        return $user->username;
    }

    /**
     * Format tha date from database
     */
    public function formatDate()
    {
        return date("G:i d F, Y", strtotime($this->date));
    }

}
