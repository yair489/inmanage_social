<?php



class Users{
    /**
     * uniqe username
     * @var integer
     */
    public $user_id;
    
    /**
     * username
     * @var string
     */
    public $user_name;
    
    /**
     * enail
     * @var string
     */
    public $email;
    
    /**
     * if(active):true; else:false
     * @var boolean 
     */
    public $active;
    
    /**
     * The birthday date 
     * @var datetime 
     */
    public $birthday;
    
    /**
     * @var varchar 255 
     */
    public $password;
    
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
}