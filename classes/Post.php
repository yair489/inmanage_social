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
     * Validation errors
     * @var array
     */
    public $errors = [];


    /**
     * Get all the posts
     *
     * @param object $conn Connection to the database
     *
     * @return array An associative array of all the article records
     */
    public static function getAll($conn)
    {
        $sql = "SELECT *
                FROM post
                ORDER BY create_at;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * 
     */
    public static function getByUserID($conn ,$id)
    {
        $sql = "SELECT *
                FROM post
                WHERE user_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'post');

        if ($stmt->execute()) {

            return $stmt->fetchAll();

        }
    }

    public static function getByID($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns
                FROM post
                WHERE post_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');

        if ($stmt->execute()) {

            return $stmt->fetch();

        }
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
        if ($this->validate()) {

            $sql = "UPDATE post
                    SET title = :title,
                        content = :content,
                        create_at = :create_at
                    WHERE post_id = :post_id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':post_id', $this->post_id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            // if ($this->create_at == '') {
            //     $stmt->bindValue(':create_at', null, PDO::PARAM_NULL);
            // } else {
                $stmt->bindValue(':create_at', $this->create_at, PDO::PARAM_STR);
            // }

            return $stmt->execute();

        } else {
            return false;
        }
    }

    /**
     * 
     */
    public function delete($conn)
    {
        $sql = "DELETE FROM post
                WHERE post_id = :post_id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':post_id', $this->post_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * 
     */
    public function create($conn)
    {
        if ($this->validate()) {

            $sql = "INSERT INTO post (user_id, title, content, create_at)
                    VALUES (:user_id, :title, :content, :create_at)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);  // Bind as integer
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':create_at', $this->create_at, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->post_id = $conn->lastInsertId();
                return true;
            }

        } else {
            return false;
        }
}

    /**
     * 
     */
    protected function validate()
    {
        // if ($this->title == '') {
        //     $this->errors[] = 'Title is required';
        // }
        // if ($this->content == '') {
        //     $this->errors[] = 'Content is required';
        // }

        // if ($this->published_at != '') {
        //     $date_time = date_create_from_format('Y-m-d H:i:s', $this->published_at);
            
        //     if ($date_time === false) {

        //         $this->errors[] = 'Invalid date and time';

        //     } else {

        //         $date_errors = date_get_last_errors();

        //         if ($date_errors['warning_count'] > 0) {
        //             $this->errors[] = 'Invalid date and time';
        //         }
        //     }
        // }

        // return empty($this->errors);
        return true;
    }

}