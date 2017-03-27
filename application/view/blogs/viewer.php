<?php session_start(); ?>
<div class="container">
    <h2>You are in the View: application/view/blogs/viewer.php (everything in this box comes from that file)</h2>
    <div class="box">
        <h3><?php echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></h3>
		<p><?php echo htmlspecialchars($blog->username, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php echo htmlspecialchars_decode($blog->text, ENT_QUOTES); ?>
		<p><?php echo htmlspecialchars($blog->data, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</div>