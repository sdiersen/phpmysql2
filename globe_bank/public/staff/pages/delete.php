<?php

require_once('../../../private/initialize.php');

  require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

$page = find_page_by_id($id);
$subject = find_subject_by_id($page['subject_id']);

if(is_post_request()) {

  $_SESSION['status_msg'] = 'The page: ' . h($page['menu_name']) . ' was successfully deleted.';
  $result = delete_page($id);
  redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))));

} else {
  
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">&laquo; Back to <?php echo h($subject['menu_name']); ?></a>
  <div class="page delete">
    <h1>Delete Page</h1>
    <p>Are you sure you want to delete this page?</p>
    <p class="item"><?php echo h($page['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
