<?php



class Post{
    /**
     * uniqe 
     * @var integer
     */
    public $post_id;
    
    /**
     * uniqe username
     * @var integer
     */
    public $user_id;
    
    /**
     * post title
     * @var string
     */
    public $title;
    
    /**
     * post cintent
     * @var Text
     */
    public $content;
    
    /**
     * when is create
     * @var Datetime
     */
    public $create_at;
    
    /**
     * if(active):true; else:false
     * @var boolean 
     */
    public $active;

    /**
     * 
     */
    public static function getAll($conn)
    {

    }
    
    /**
     * 
     */
    public static function getByID($conn)
    {
    }

    /**
     * 
     */
    public static function getByActiveUser($conn)
    {
    }

    /**
     * 
     */
    public static function getByBirthday($conn)
    {
    }

    /**
     * 
     */
    public function update($conn)
    {
    }

    /**
     * 
     */
    public function delete($conn)
    {
    }

    /**
     * 
     */
    public function create($conn)
    {
    }

    /**
     * 
     */
    protected function validate()
    {
    }

}