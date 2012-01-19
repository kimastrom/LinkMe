<?php
Doo::loadModel('base/Link_ratingBase');

class Link_rating extends Link_ratingBase
{
    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $user_id;

    /**
     * @var int Max length is 11.
     */
    public $link_id;

    /**
     * @var tinyInt Max length is 4
     */
    public $rating;

    public $_table = 'link_rating';
    public $_primarykey = 'id';
    public $_fields = array('id', 'user_id', 'link_id', 'rating');

    public function __construct($data = null)
    {
        parent::__construct($data);
        parent::setupModel(__CLASS__);
    }

    public function getRating()
    {
        $opt['where'] = 'link_id = ?';
        $opt['param'] = array($this->link_id);
        $obj = $this->find($opt);
        $rating = 0;
        foreach ($obj as $linkRating) {
            $rating += $linkRating->rating;
        }
        return $rating;
    }

    public function hasVoted($linkID)
    {
        if ($this->user_id == $userID) {
            return true;
        }
        return false;
    }

    public function doVote($vote,$link)
    {
        $session = Doo::session("LinkMe");
        $lr = new Link_rating();
        $lr->user_id = $session->get('id');
        $lr->link_id = $link;
        $lr = $lr->find(array('limit', 1));

        if (!empty($lr)) {
            $lr = $lr[0];
            if (($vote == 'up' && $lr->rating > 0) || ($vote == 'down' && $lr->rating < 0)) {
                return false;
            } else {
                if ($vote == 'up') {
                    $lr->rating = 1;
                } else if ($vote == 'down') {
                    $lr->rating = -1;
                } else {
                    return false;
                }
                $lr->update();
            }
            return true;
        } else {
            $lr = new Link_rating();
            $lr->user_id = $session->get('id');
            $lr->link_id = $link;
            if ($vote == 'up') {
                $lr->rating = 1;
            } else if ($vote == 'down') {
                $lr->rating = -1;
            } else {
                return false;
            }
            $lr->insert();
        }
    }

}
