<?php session_start();?>
<div class="container">
    <h2>You are in the View: application/view/blogs/usersearch.php.</h2>
	<?php foreach ($blogs as $blog) { ?>
    <div class="box">
        <h3><?php if (isset($blog->title)) echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></h3>
		<p><?php if (isset($blog->username)) echo htmlspecialchars($blog->username, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php if (isset($blog->text)) echo htmlspecialchars_decode($blog->text, ENT_QUOTES); ?>
		<p><?php if (isset($blog->data)) echo htmlspecialchars($blog->data, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
	<?php } ?>
</div>