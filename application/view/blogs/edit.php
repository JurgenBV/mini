<?php session_start(); ?>
<script src="/mini-master/mini/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="container">
    <h2>You are in the View: application/view/blogs/edit.php (everything in this box comes from that file)</h2>
    <div>
        <h3>Edit a blog</h3>
        <form action="<?php echo URL; ?>blogs/updateblog" method="POST">
            <label>Title</label>
            <input autofocus type="text" name="title" value="<?php echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Text</label>
			<textarea id="edit" name="text">
				<?php
					echo htmlspecialchars_decode($blog->text, ENT_QUOTES);
				?>
			</textarea>
			<script>
				CKEDITOR.replace( 'edit' );
			</script>
            <input type="hidden" name="blog_id" value=<?php echo htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?> />
            <input type="submit" name="submit_update_blog" value="Update" />
        </form>
    </div>
</div>