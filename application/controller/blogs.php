<?php
class Blogs extends Controller
{
	public function index()
	{
		$blogs = $this->model->getAllBlogs();
		$amount_of_blogs = $this->model->getAmountOfBlogs();
		$users = $this->model->getAllUsers();
		//$ckeditor = $this->model->text_editor();
		
		require APP . 'view/_templates/header.php';
		require APP . 'view/blogs/index.php';
		require APP . 'view/_templates/footer.php';
	}
	
	public function addBlog()
	{
		if (isset($_POST["submit_add_blog"])) {
			$this->model->addBlog($_POST["username_id"], $_POST["title"], $_POST["text"]);
		}
		header('location: ' . URL . 'blogs/index');
	}
	
	public function deleteBlog($blog_id)
	{
		if (isset($_POST["submit_deletion_blog"])) {	
			$this->model->deleteBlog($_POST['blog_id']);
		}
		header('location: ' . URL . 'blogs/index');
	}
	public function editBlog($blog_id)
    {
        if (isset($blog_id)) {
            $blog = $this->model->getBlog($blog_id);
            require APP . 'view/_templates/header.php';
            require APP . 'view/blogs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'blogs/index');
        }
    }
	public function delete($blog_id)
	{
		if (isset($blog_id)) {
            $blog = $this->model->getBlog($blog_id);
            require APP . 'view/_templates/header.php';
            require APP . 'view/blogs/delete.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'blogs/index');
        }
	}
	public function viewer($blog_id)
	{
		if (isset($blog_id)) {
			$blog = $this->model->getBlog($blog_id);
			require APP . 'view/_templates/header.php';
			require APP . 'view/blogs/viewer.php';
			require APP . 'view/_templates/footer.php';
		} else {
			header('location: ' . URL . 'blogs/index');
		}
	}
	public function userviewer($user_id)
	{
		if (isset($user_id)) {
			$username = $this->model->getUser($user_id);
			$blogs = $this->model->getBlogsFromUser($user_id);
			require APP . 'view/_templates/header.php';
			require APP . 'view/blogs/userviewer.php';
			require APP . 'view/_templates/footer.php';
		} else {
			//header('location: ' . URL . 'blogs/index');
		}
	}
	public function search()
	{
		if (isset($_POST["submit_search_word"])) {
			$blogs = $this->model->getBlogsBySearchword($_POST["searchfor"]);
			require APP . 'view/_templates/header.php';
			require APP . 'view/blogs/search.php';
			require APP . 'view/_templates/footer.php';
		} else {
			header('location: ' . URL . 'blogs/index');
		}
	}
	public function usersearch()
	{
		if (isset($_POST["submit_search_word"])) {
			$blogs = $this->model->getUsersBlogsBySearchword($_POST["searchfor"], $_POST["username"]);
			require APP . 'view/_templates/header.php';
			require APP . 'view/blogs/usersearch.php';
			require APP . 'view/_templates/footer.php';
		} else {
			header('location: ' . URL . 'blogs/index');
		}
	}
	public function updateBlog()
    {
        if (isset($_POST["submit_update_blog"])) {
            $this->model->updateBlog($_POST["title"],  $_POST["text"], $_POST['blog_id']);
        }

        header('location: ' . URL . 'blogs/index');
    }
	public function text_editor()
	{
		$this->model->text_editor("yourfieldname", "", "Basic", "80%", "10");
	}
	public function ajaxGetStats()
	{
		$amount_of_blogs = $this->model->getAmountOfBlogs();
		echo $amount_of_blogs;
	}
	public function login()
	{
		if (isset($_POST["login"])) {
			//$_SESSION["id"] = $this->model->getId($_POST["username"], $_POST["password"]);
			$this->model->login($_POST["username"], $_POST["password"]);
		}
		
		header('location: ' . URL . 'blogs/index' . SID);
	}
	public function logout()
	{
		session_start();
		if (isset($_POST["logout"])) {
			if (isset($_SESSION["username"])) {
				$this->model->logout();
			}
		}
		header('location: ' . URL . 'blogs/index');
	}
}