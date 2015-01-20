<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):

	if (isset($_POST['myname'])) { $myname = $_POST['myname']; }
	if (isset($_POST['mypassword'])) { $mypassword = $_POST['mypassword']; }
	if (isset($_POST['mypasswordconf'])) { $mypasswordconf = $_POST['mypasswordconf']; }
	if (isset($_POST['mycomments'])) { $mycomments = $_POST['mycomments']; }
	if (isset($_POST['reference'])) { $reference = $_POST['reference']; }
	if (isset($_POST['favoritemusic'])) { $favoritemusic = $_POST['favoritemusic']; }
	if (isset($_POST['requesttype'])) { $requesttype = $_POST['requesttype']; }


	if ($myname === '') :
		$err_myname = '<div class="error">Sorry, your name is a required field</div>';
	endif; // input field empty

	if (strlen($mypassword) <= 6):
		$err_passlength = '<div class="error">Sorry, the password must be at least six characters</div>';
	endif; //password not long enough


	if ($mypassword !== $mypasswordconf) :
		$err_mypassconf = '<div class="error">Sorry, passwords must match</div>';
	endif; //passwords don't match


	if ( !(preg_match('/[A-Za-z]+, [A-Za-z]+/', $myname)) ) :
		$err_patternmatch = '<div class="error">Sorry, the name must be in the format: Last, First</div>';
	endif; // pattern doesn't match


endif; //form submitted
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Form Sample</title>
	<link rel="stylesheet" href="normalize.css" />
	<link rel="stylesheet" href="mystyle.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body>
<form id="myform" name="theform" class="group" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<span id="formerror" class="error"></span>
		<ol>
			<li>
				<label for="myname">Name *</label>
				<input type="text" name="myname" id="myname" title="Please enter your name" autofocus placeholder="Last, First" value="<?php if (isset($myname)) { echo $myname; } ?>" />
				<?php if (isset($err_myname)) { echo $err_myname; } ?>
				<?php if (isset($err_patternmatch)) { echo $err_patternmatch; } ?>
			</li>
			<li>
				<label for="mypassword">Password</label>
				<input type="password" name="mypassword" id="mypassword" value="<?php if (isset($mypassword)) { echo $mypassword; } ?>" />
				<?php if (isset($err_passlength)) { echo $err_passlength; } ?>
			</li>
			<li>
				<label for="mypasswordconf">Password (confirm)</label>
				<input type="password" name="mypasswordconf" id="mypasswordconf" value="<?php if (isset($mypasswordconf)) { echo $mypasswordconf; } ?>" />
				<?php if (isset($err_mypassconf)) { echo $err_mypassconf; } ?>
			</li>
			<li>
				<div class="grouphead">Favorite Music</div>
				<ol>
					<li>
						<input type="checkbox" name="favoritemusic[]" value="rock" id="rockitem" 
						<?php if ((isset($favoritemusic)) && (in_array("rock", $favoritemusic))) { echo "checked"; } ?> />
						<label for="rockitem">Rock</label>
					</li>
					<li>
						<input type="checkbox" name="favoritemusic[]" value="classical" id="classicalitem"
						<?php if ((isset($favoritemusic)) && (in_array("classical", $favoritemusic))) { echo "checked"; } ?> />
						<label for="classicalitem">Classical</label>
					</li>
					<li>
						<input type="checkbox" name="favoritemusic[]" value="reggaeton" id="reggaetonitem"
						<?php if ((isset($favoritemusic)) && (in_array("reggaeton", $favoritemusic))) { echo "checked"; } ?> />
						<label for="reggaetonitem">Reggaeton</label>
					</li>
				</ol>
			</li>
			<li>
				<label for="reference">How did you hear about us?</label>
				<select name="reference" id="reference">
					<option value="">Choose...</option>
					<option value="friend"
					<?php if ((isset($reference)) && ($reference === 'friend')) { echo "selected"; } ?>>A friend</option>
					<option value="facebook"
					<?php if ((isset($reference)) && ($reference === 'facebook')) { echo "selected"; } ?>>Facebook</option>
					<option value="twitter"
					<?php if ((isset($reference)) && ($reference === 'twitter')) { echo "selected"; } ?>>Twitter</option>
				</select>
			</li>
			<li>
				<div class="grouphead">Request Type</div>
				<ol>
					<li>
						<input type="radio" name="requesttype" value="question" id="questionitem" <?php if ((isset($requesttype)) && ($requesttype==='question')) { echo "checked"; } ?>/>
						<label for="questionitem">Question</label>
					</li>
					<li>
						<input type="radio" name="requesttype" value="comment" id="commentitem" <?php if ((isset($requesttype)) && ($requesttype === 'comment')) { echo "checked"; } ?> />
						<label for="commentitem">Comment</label>
					</li>
					<li>
						<input type="radio" name="requesttype" value="suggestion" id="suggestionitem" <?php if ((isset($requesttype)) && ($requesttype === 'suggestion')) { echo "checked"; } ?> />
						<label for="suggestiontem">Suggestion</label>
					</li>
				</ol>
			</li>
			<li>
				<label for="mycomments">Comment</label>
				<textarea name="mycomments" id="mycomments"><?php if (isset($mycomments)) { echo $mycomments; } ?></textarea>
			</li>
		</ol>
		<button type="submit" name="action" value="submit">send</button>
</form>
</body>
</html>

