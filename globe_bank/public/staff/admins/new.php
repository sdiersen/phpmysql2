<?php 

	require_once('../../../private/initialize.php');

	if(is_post_request()) {
		$admin = [];
		$admin['first_name'] = $_POST['first_name'] ?? '';
		$admin['last_name'] = $_POST['last_name'] ?? '';
		$admin['email'] = $_POST['email'] ?? '';
		$admin['username'] = $_POST['username'] ?? '';
		$admin['password'] = $_POST['password'] ?? '';

		$result = insert_admin($admin);
		if($result === true) {
			$_SESSION['status_msg'] = "Admin account successfully created.";
			$new_id = mysqli_insert_id($db);
    		redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
		} else {
			$errors = $result;
		}
	} else {
		$admin = [];
		$admin['first_name'] = '';
		$admin['last_name'] = '';
		$admin['email'] = '';
		$admin['username'] = '';
		$admin['password'] = '';
	}
	
	$page_title = 'Admin - New';
	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

	<div class="admins new">
		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
			<dl>
				<dt>First Name: </dt>
				<dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Last Name: </dt>
				<dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Email: </dt>
				<dd><input type="email" name="email" value="<?php echo h($admin['email']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Username: </dt>
				<dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Password: </dt>
				<dd><input type="password" name="password" value="<?php echo h($admin['password']); ?>" /> </dd>
			</dl>
			<div id="operation">
				<input type="submit" value="Create Admin" />
			</div>
		</form>
	</div>	
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>