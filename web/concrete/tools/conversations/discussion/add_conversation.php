<?php defined('C5_EXECUTE') or die("Access Denied.");
$ax = Loader::helper('ajax');
$vs = Loader::helper('validation/strings');
$ve = Loader::helper('validation/error');
$u  = new User;

if (Loader::helper('validation/numbers')->integer($_POST['cnvDiscussionID'])) {
	$discussion = ConversationDiscussion::getByID($_POST['cnvDiscussionID']);
}
if (!is_object($discussion)) {
	$ve->add(t('Invalid discussion.'));
}

if (!Loader::helper('validation/token')->validate('add_discussion_conversation', $_POST['token'])) {
	$ve->add(t('Invalid conversation post token.'));
}

$subject = Loader::helper('security')->sanitizeString($_POST['cnvDiscussionSubject']);
if (!$vs->notempty($subject)) {
	$ve->add(t('Your subject cannot be empty.'));
}

if (!$vs->notempty($_POST['cnvMessageBody'])) {
	$ve->add(t('Your message cannot be empty.'));
}


/*

$cnvMessageSubject = null;
if (Loader::helper('validation/numbers')->integer($_POST['cnvID'])) {
	$cn = Conversation::getByID($_POST['cnvID']);
}
if (!is_object($cn)) {
	$ve->add(t('Invalid conversation.'));
}
if (!$vs->notempty($_POST['cnvMessageBody'])) {
	$ve->add(t('Your message cannot be empty.'));
}

if (Loader::helper('validation/numbers')->integer($_POST['cnvMessageParentID']) && $_POST['cnvMessageParentID'] > 0) {
	$parent = ConversationMessage::getByID($_POST['cnvMessageParentID']);
	if (!is_object($parent)) {
		$ve->add(t('Invalid parent message.'));
	}
}

if (Config::get('CONVERSATION_DISALLOW_BANNED_WORDS') && Loader::helper('validation/banned_words')->hasBannedWords($_POST['cnvMessageBody'])) {
	$ve->add(t('Banned words detected.'));
}
*/

if ($ve->has()) {
	$ax->sendError($ve);
} else {
	/*
	$msg = $cn->addMessage($cnvMessageSubject, $_POST['cnvMessageBody'], $parent);
	if (!Loader::helper('validation/antispam')->check($_POST['cnvMessageBody'],'conversation_comment')) {
		$msg->flag(ConversationFlagType::getByHandle('spam'));
	} else {
		$msg->approve();
	}
	if ($wlg instanceOf Group && $u->inGroup($wlg)) {
		$msg->approve();
	}
	if($_POST['attachments'] && count($_POST['attachments'])) {
		foreach($_POST['attachments'] as $attachmentID) {
			ConversationMessage::attachFile(File::getByID($attachmentID), $msg->cnvMessageID);
		}
	}
	*/

	$ax->sendResult($c);
}