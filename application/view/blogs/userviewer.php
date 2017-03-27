<?php session_start();?>
<div class="container">
    <h2>You are in the View: application/view/blogs/userviewer.php. You were searching for <?php echo htmlspecialchars($username->username, ENT_QUOTES, 'UTF-8');?>.</h2>
	<h3>Search through these blogs</h3>
		<form action="<?php echo URL; ?>blogs/usersearch" method="POST">
			<input type="text" name="searchfor" value="" required />
			<input type="hidden" name="username" value="<?php echo htmlspecialchars($username->username, ENT_QUOTES, 'UTF-8');?>" /> 
			<input type="submit" name="submit_search_word" value="Start search" />
		</form>
	<?php foreach ($blogs as $blog) { ?>
    <div class="box">
        <h3><?php if (isset($blog->title)) echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></h3>
		<p><?php if (isset($blog->username)) echo htmlspecialchars($blog->username, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php if (isset($blog->text)) echo htmlspecialchars_decode($blog->text, ENT_QUOTES); ?>
		<p><?php if (isset($blog->data)) echo htmlspecialchars($blog->data, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
	<?php } ?>
</div>