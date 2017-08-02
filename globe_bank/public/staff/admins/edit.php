<?php 

	require_once('../../../private/initialize.php');

	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/admins/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$account = [];
		$account['id'] = $id;
		$account['first_name'] = $_POST['first_name'] ?? '';
		$account['last_name'] = $_POST['last_name'] ?? '';
		$account['email'] = $_POST['email'] ?? '';
		$account['username'] = $_POST['username'] ?? '';
		$account['hashed_password'] = $_POST['hashed_password'] ?? '';

		$result = update_admin($account);
		if($result === true) {
			$_SESSION['status_msg'] = 'Account updated successfully';
			redirect_to(url_for('/staff/admins/show.php?id=' . $id));
		} else {
			$errors = $result;
		}
	} else {
		$account = find_admin_by_id($id);
	}
	
	$page_title = 'Admin - Edit';
	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php');?>">&laquo; Back to List</a>

	<div class="admins edit">
		<h1>Edit Admin</h1>

		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
			<dl>
				<dt>First Name: </dt>
				<dd><input type="text" name="first_name" value="<?php echo h($account['first_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Last Name: </dt>
				<dd><input type="text" name="last_name" value="<?php echo h($account['last_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Email: </dt>
				<dd><input type="email" name="email" value="<?php echo h($account['email']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Username: </dt>
				<dd><input type="text" name="username" value="<?php echo h($account['username']); ?> " /></dd>
			</dl>
			<dl>
				<dt>Password: </dt>
				<dd><input type="password" name="hashed_password" value="<?php echo h($account['hashed_password']); ?>" /></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Edit Account" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>