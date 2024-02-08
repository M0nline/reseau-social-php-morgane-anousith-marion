<?php $dateAndTime = strtotime($post['created']);
$formatedDateTime = date('d-m-Y à H:i:s', $dateAndTime); ?>
<time datetime='<?php echo $post['created'] ?>'><?php echo $formatedDateTime ?></time>