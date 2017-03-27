<?php session_start(); ?>
<div class="container">
	<h2>Are you sure you want to delete blog number <?php echo htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>?</h2>
	<div>
		<p><?php echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php echo htmlspecialchars_decode($blog->text, ENT_QUOTES); ?>
		<p><?php echo htmlspecialchars($blog->data, ENT_QUOTES, 'UTF-8'); ?></p>
	</div>
	<div>
		<form action="<?php echo URL; ?>blogs/deleteblog" method="POST">
			<input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>" />
			<input type="submit" name="submit_deletion_blog" value="Yes" />
			<input type="submit" name="back" value="No" />
		</form>
	</div>
</div>