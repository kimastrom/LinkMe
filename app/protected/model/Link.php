<?php
Doo::loadModel('base/LinkBase');

class Link extends LinkBase
{
    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 150.
     */
    public $url;

    /**
     * @var varchar Max length is 200.
     */
    public $description;

    /**
     * @var timestamp
     */
    public $date;

    /**
     * @var int Max length is 11.
     */
    public $user_id;

    /**
     * @var int Max length is 11.
     */
    public $category_id;

    /**
     * @var int Max length is 11.
     */
    public $nrOfComments;

    /**
     * @var int Max length is 11.
     */
    public $rating;
    
    /**
     * @var string.
     */
    public $author;

    public $_table = 'link';
    public $_primarykey = 'id';
    public $_fields = array('id', 'url', 'description', 'date', 'user_id', 'category_id');

    public function __construct($data = null)
    {
        parent::__construct($data);
        parent::setupModel(__CLASS__);
        $this->nrOfComments = $this->getNrOfComments();
        $this->rating = $this->getRating();
        
        if(isset($this->id)) {
            $this->author = $this->getAuthor();
            $this->isOwner = $this->isOwner();
        }
    }

    /**
     * calculate the total rating of this link
     * @return int the rating of link
     */
    public function getRating()
    {
        $rating = 0;
        if ($this->id != null) {
            $obj = Doo::loadModel('Link_rating', true);
            $obj = Doo::db()->find($obj, array('where' => "link_id=$this->id"));
            foreach ($obj as $linkRating) {
                $rating += $linkRating->rating;
            }
        }

        return $rating;
    }

    /**
     * calculate number of comments of this link
     * @return int number of comments
     */
    public function getNrOfComments()
    {
        if ($this->id != null) {
            $obj = Doo::loadModel('Comment', true);
            $obj = Doo::db()->find($obj, array('where' => "link_id=$this->id"));
            $comments = count($obj);
            return $comments;
        }
        return 0;

    }
    
    /**
     * check if current inlogged user is owner of this link
     */
    public function isOwner()
    {
        $session = Doo::session("LinkMe");
        if ($session->get('id') == $this->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Get the author name of this Link
     * @return String username
     */
    public function getAuthor()
    {
        Doo::loadModel('User');
        $user = new User();
        $user->id = $this->user_id;
        $user = $user->getOne();
        return $user->username;
    }

    public function formatDate()
    {
        return date("G:i d F, Y", strtotime($this->date));
    }

    /**
     * handle the sorting by most comments
     */
    function sorByComments($a, $b)
    {
        if ($a->nrOfComments == $b->nrOfComments) {
            return 0;
        }
        return ($a->nrOfComments < $b->nrOfComments) ? -1 : 1;
    }

    /**
     * handle the sorting by rating
     */
    function sortByRating($a, $b)
    {
        if ($a->rating == $b->rating) {
            return 0;
        }
        return ($a->rating < $b->rating) ? -1 : 1;
    }

    /**
     * Sorts links by most comments
     * @return Array with link objects
     */
    public function mostComments()
    {
        $links = $this->find();

        usort($links, array("Link", "sorByComments"));
        $links = array_reverse($links);

        return $links;
    }

    /**
     * Sorts links by highest rate
     * @return array with link objects
     */
    public function highestRate()
    {
        $links = $this->find();

        usort($links, array("Link", "sortByRating"));
        $links = array_reverse($links);

        return $links;
    }

}
