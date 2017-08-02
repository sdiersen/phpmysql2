<?php 

	require_once('../../../private/initialize.php');
	
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/admins/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$admin = find_admin_by_id($id);
		$_SESSION['status_msg'] = 'User: ' . h($admin['username']) . ' was successfully removed from the database';
		$result = delete_admin($id);
		redirect_to(url_for('/staff/admins/index.php'));
	} else {
		$admin = find_admin_by_id($id);
	}
	
	$page_title = 'Admin - Delete';
	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

	<div class="admins delete">
		<h1>Delete Admin</h1>
		<p>Are you sure you want to delete this admin?</p>
		<p class="item"><?php echo h($admin['username']);?></p>
		<form action="<?php url_for('/staff/admins/delete?id=' . h(u($admin['id']))); ?>" method="post">
			<div id="operations">
				<input type="submit" name="commit" value="Delete Admin" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>