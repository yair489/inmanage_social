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
    public $user_name;//user_id user_name email active birthday password
    
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
    
    public $content;
    /**
     * 
     */
    public static function getAll($conn)
    {
        $sql = "SELECT * 
                From users
                ORDER BY user_name;";

        $res = $conn->query($sql);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * 
     */
    public static function getByID($conn , $id, $columns = '*')
    {
        $sql = "SELECT $columns
                FROM users
                WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'users');

        if ($stmt->execute()) {

            return $stmt->fetch();

        }
    }
    public static function getByActiveUser($conn)
    {
        $sql = "SELECT *
                FROM users
                WHERE active = 1
                ORDER BY user_name;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * user_id user_name email active birthday password
     */
    public function update($conn)
    {
        $sql = "UPDATE users
                SET user_id = :user_id,
                    user_name = :user_name,
                    email = :email
                    content = :content
                    active = :active,
                    birthday = :birthday,
                    password = :password
                WHERE user_id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindValue(':active', $this->active, PDO::PARAM_INT);
        $stmt->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);

        // if ($this->published_at == '') {
        //     $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
        // } else {
        //     $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
        // }

        return $stmt->execute();
    }
    
    /**
     * 
     */

    public function delete($conn)
    {
        try {
            // Start a transaction
            $conn->beginTransaction();
    
            // Delete all posts of the user
            $sql = "DELETE FROM post WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
            $stmt->execute();
    
           // Deleting the user itself
            $sql = "DELETE FROM users WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
            $stmt->execute();
    
            // confirm the transaction
            $conn->commit();
    
            return true;
    
        } catch (Exception $e) {
            // If there is an error, cancel the transaction
            $conn->rollBack();
            throw $e;
        }
    }
    
    /**
     * 
     */
    public function create($conn)//user_name content email birthday Active
    {
        $sql = "INSERT INTO users (user_name, content, email , birthday ,Active )
                    VALUES (:user_name, :content, :email , :birthday ,:Active)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
            $stmt->bindValue(':Active', $this->Active, PDO::PARAM_INT);


            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }
    }
}