<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */


?>
<?php $this->block()->start( 'email/account/text' ); ?>
<?php echo wordwrap( strip_tags( $this->get( 'emailIntro' ) ) ); ?>


<?php echo wordwrap( strip_tags( $this->translate( 'client', 'An account has been created for you.' ) ) ); ?>


<?php echo strip_tags( $this->translate( 'client', 'Your account' ) ); ?>

<?php echo $this->translate( 'client', 'Account' ); ?>: <?php	echo $this->extAccountCode; ?>

<?php echo $this->translate( 'client', 'Password' ); ?>: <?php	echo $this->extAccountPassword; ?>


<?php echo wordwrap( strip_tags( $this->translate( 'client', 'If you have any questions, please reply to this e-mail' ) ) ); ?>
<?php $this->block()->stop(); ?>
<?php echo $this->block()->get( 'email/account/text' ); ?>
