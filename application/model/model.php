<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
	
	// CKEditor code for text editor
function text_editor($field_name = "edit", $value = "", $toolbar = "User", $cols = "80%", $rows = 10)
{
   include('../ckeditor/ckeditor.js');
   
   $CKEditor = new CKEditor();
   
   $CKEditor->basePath = 'includes/ckeditor/';
   
   // Do not print the code directly to the browser, return it instead

   $CKEditor->returnOutput = true;
   
   // set the graphical look of CKEditor
   //$config['skin'] = 'office2003';   // default skin is -> kama   -->  available skins: kama, office2003, v2  --- uncomment line to use
   // User Interface Color, works only on default skin: kama
   $config['uiColor'] = '#AABBCC';  // User Interface Color ... sets CKEditor's toolbar gradient color
   
   // set up Width and Height of CKEditor
   $config['width'] = $cols;  // width can be set to pixels or percentage... For Example:  $config['width'] = 600;  -OR- $config['width'] = '90%';
   $config['height'] = $rows * 17;
   
   if($toolbar == "Basic") {
      $config['toolbar'] = array(

   array( 'Source','-','Cut', 'Copy', 'PasteText', 'PasteFromWord', '-', 'Undo','Redo','-','BidiLtr', 'BidiRtl'),
    '/',

   array( 'Bold', 'Italic', '-', 'HorizontalRule', '-', 'NumberedList','BulletedList','-','OrderedList','UnorderedList','-','Link','Unlink','Anchor','-','About')

	);
	}

   // Create editor instance.

   echo $CKEditor->editor($field_name, $value, $config); 
}

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }
	public function getAllBlogs()
	{
		$sql = "SELECT blogs.*, users.username as username from blogs left join users on blogs.username_id = users.id ORDER BY id DESC";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	public function getAmountOfBlogs()
	{
		$sql = "SELECT COUNT(id) AS amount_of_blogs FROM blogs";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch()->amount_of_blogs;
	}
	public function addBlog($username_id, $title, $text)
	{
		$sql = "INSERT INTO blogs (username_id, title, text, data) VALUES (:username_id, :title, :text, :data)";
		$query = $this->db->prepare($sql);
		$parameters = array(':username_id' => $username_id, ':title' => $title, ':text' => $text, ':data' => date("Y-m-d H:i:s"));
		$query->execute($parameters);
	}
	public function deleteBlog($blog_id)
	{
		$sql = "DELETE FROM blogs WHERE id = :blog_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':blog_id' => $blog_id);
		$query->execute($parameters);
	}
	public function getBlog($blog_id)
	{
		$sql = "SELECT blogs.*, users.username from blogs left join users on blogs.username_id = users.id WHERE blogs.id = :blog_id LIMIT 1";
		$query = $this->db->prepare($sql);
		$parameters = array(':blog_id' => $blog_id);
		$query->execute($parameters);
		return $query->fetch();
	}
	public function getBlogsFromUser($user_id)
	{
		$sql = "SELECT blogs.*, users.username as username from blogs left join users on blogs.username_id = users.id WHERE users.id = :user_id ORDER BY id DESC";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id);
		$query->execute($parameters);
		return $query->fetchAll();
		
	}
	public function getBlogsBySearchword($word)
	{
		$sql = "SELECT blogs.*, users.username as username from blogs left join users on blogs.username_id = users.id WHERE blogs.text LIKE :word";
		$query = $this->db->prepare($sql);
		$parameters = array(':word' => '%' . $word . '%');
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function getUsersBlogsBySearchword($word, $username)
	{
		$sql = "SELECT blogs.*, users.username as username from blogs left join users on blogs.username_id = users.id WHERE blogs.text LIKE :word AND users.username LIKE :username";
		$query = $this->db->prepare($sql);
		$parameters = array(':word' => '%' . $word . '%', ':username' => $username);
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function updateBlog($title, $text, $blog_id)
    {
        $sql = "UPDATE blogs SET title = :title, text = :text, data = :data WHERE id = :blog_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':title' => $title, ':text' => $text, ':data' => date("Y-m-d H:i:s"), ':blog_id' => $blog_id);

		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
	public function login($username, $password)
	{
		session_start();
		$sql = "SELECT * from users WHERE username = :username and password = :password";
		$query = $this->db->prepare($sql);
		$parameters = array(':username' => $username, ':password' => $password);
		$query->execute($parameters);
		$result = $query->fetch();
		var_dump($result);
		if($result != null){
			$_SESSION["username"] = $username;
			$_SESSION["id"] = $result->id;
			echo $_SESSION["username"];
			echo $_SESSION["id"];
			echo 'Login Successful';
		}
	}
	public function logout()
	{
		echo $_SESSION["username"];
		session_destroy();
		echo 'Logout Succesful';
	}
	public function getAllUsers()
	{
		$sql = "SELECT * from users";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	public function getUser($user_id)
	{
		$sql = "SELECT username from users WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(':id' => $user_id);
		$query->execute($parameters);
		return $query->fetch();
	}
}