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
     * Get all the user
     *
     * @param object $conn Connection to the database
     *
     * @return object users
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
    /**
     * Get all the user who active 
     *
     * @param object $conn Connection to the database
     *
     * @return object specific user
     */
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
    * Updates a user's information in the `users` table.
    *
    * This function prepares and executes an SQL statement to update a user's details in the database.
    * The following fields are updated: `user_id`, `user_name`, `email`, `content`, `active`, `birthday`, and `password`.
    *   The function uses prepared statements to prevent SQL injection.
    *
    * @return bool Returns `true` on success or `false` on failure.
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

        return $stmt->execute();
    }
    
    /**
    * Deletes a user and all associated posts from the database.
    *
    * This function performs the following steps:
    * 1. Starts a database transaction.
    * 2. Deletes all posts associated with the user from the `post` table.
    * 3. Deletes the user itself from the `users` table.
    * 4. Commits the transaction if both deletions succeed.
    *
    * If an error occurs during the process, the transaction is rolled back, ensuring no partial deletions occur.
    *
    * @param PDO $conn The PDO connection object to the database.
    * @return bool Returns `true` on successful deletion, or throws an exception if an error occurs.
    * @throws Exception If an error occurs, it throws the exception after rolling back the transaction.
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
    * Creates a new user record in the `users` table.
    *
    * This function inserts a new user into the database with the following fields:
    * `user_name`, `content`, `email`, `birthday`, and `Active`.
    * The function uses prepared statements to prevent SQL injection.
    * 
    * If the insertion is successful, the function retrieves the ID of the newly inserted user 
    * and assigns it to the object's `id` property.
    *
    * @param PDO $conn The PDO connection object to the database.
    * @return bool Returns `true` on successful insertion, or `false` if the execution fails.
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