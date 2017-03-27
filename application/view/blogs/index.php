<?php session_start(); ?>
<script src="/mini-master/mini/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="container">
	<?php if (isset($_SESSION["username"])) { ?>
		<h2>Welcome, <?php echo $_SESSION["username"];?>! The datetime is <?php echo date("Y-m-d H:i:s");?></h2>
	<?php }else{ ?>
		<h2>You are in the View: application/view/blogs/index.php. The datetime is <?php echo date("Y-m-d H:i:s");?></h2>
	<?php } ?>
	<div class="box">
	<?php if (!isset($_SESSION["username"])) { ?>
		<h3>If you want to write your own blog, please login first</h3>
		<form action="<?php echo URL; ?>blogs/login" method="POST">
			<label>Username</label>
			<input type="text" name="username" value="" required />
			<label>Password</label>
			<input type="password" name="password" value="" required />
			<input type="submit" name="login" value="Log in" />
		</form>
	<?php }else{ ?>
		<form action="<?php echo URL; ?>blogs/logout" method="POST">
			<input type="submit" name="logout" value="Log out" />
		</form>
	</div>
	<div class="box">
		<form action="<?php echo URL; ?>blogs/addblog" method="POST">
            <!--label>Username_id</label-->
            <input type="hidden" name="username_id" value="<?php echo $_SESSION["id"];?>" required />
            <label>Title</label>
            <input type="text" name="title" value="" required />
            <label>Text</label>
			<textarea id="edit" name="text" value=""></textarea>
			<script>
				CKEDITOR.replace( 'edit' );
			</script>
            <input type="submit" name="submit_add_blog" value="Submit" />
        </form>
	<?php } ?>
	</div>
	<div class="box">
		<h3>Amount of blogs (data from second model)</h3>
		<div>
			<?php echo $amount_of_blogs; ?>
		</div>
		<h3>List of users</h3>
			<ul>
			<?php foreach ($users as $user) { ?>
				<li><a href="<?php echo URL . 'blogs/userviewer/' . htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8');?></a></li>
			<?php } ?>
			</ul>
		<h3>Search through the blogs</h3>
		<form action="<?php echo URL; ?>blogs/search" method="POST">
			<input type="text" name="searchfor" value="" required />
			<input type="submit" name="submit_search_word" value="Start search" />
		</form>
		<h3>List of blogs</h3>
		<table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
				<td>Username</td>
				<td>title</td>
				<td>text</td>
				<td>data</td>
				<?php if (isset($_SESSION["username"])) { ?>
				<td>DELETE</td>
                <td>EDIT</td>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($blogs as $blog) { ?>
				<tr>
					<td><?php if (isset($blog->username)) echo htmlspecialchars($blog->username, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><a href="<?php echo URL . 'blogs/viewer/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($blog->title)) echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></a></td>
					<td><?php if (isset($blog->text)) {
						$blog->text = strip_tags($blog->text);
						$blog->text = str_replace(chr(10), "",$blog->text);
						$blog->text = str_replace(chr(13), " ",$blog->text);
						$blog->text = str_replace(chr(160), "",$blog->text);
						if (strlen($blog->text) > 50) {$blog->text = substr($blog->text, 0, 50) . "...";}
						echo htmlspecialchars($blog->text, ENT_QUOTES, 'UTF-8');} ?></td>
					<td><?php if (isset($blog->data)) echo htmlspecialchars($blog->data, ENT_QUOTES, 'UTF-8'); ?></td>
					<?php if (isset($_SESSION["username"])) { ?>
					<td><a href="<?php echo URL . 'blogs/delete/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
					<td><a href="<?php echo URL . 'blogs/editblog/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
					<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>