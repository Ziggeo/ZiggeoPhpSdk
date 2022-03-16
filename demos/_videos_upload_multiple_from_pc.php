<?php

// Uploading multiple files to the Ziggeo servers through PHP SDK

//This works by submitting the files directly to the form from your PC or Mac to your server, from where it goes to Ziggeo

//Needed steps:
// 1. Download the latest Ziggeo PHP SDK from GitHub https://github.com/Ziggeo/ZiggeoPhpSdk
// 2. extract the files
// 3. reference the files in this file
// 4. Add correct details from your app
// 5. submit your videos

// Good thing to note is that this demo shows you how to upload videos to your PHP server first, then fires the calls to Ziggeo server from your server as files come in.
// So your server needs to be set to allow a lot of time to process this.

define('APP_TOKEN', '');
define('PRIVATE_KEY', '');

//We quickly check if we have post, 'submitted' field and 'submitted' value..If we have all that, then we check if we have videos as well
if(isset($_POST, $_POST['submitted']) && $_POST['submitted'] === 'submitted' && isset($_FILES)) {
	//This is where we actually process everything

	//We require the Ziggeo SDK Entry file
	require_once('Ziggeo.php');

	$arguments = Array();

	//OK we have some tags set, we should add them to the videos
	if(isset($_POST['tags'])) {
		$arguments['tags'] = $_POST['tags'];
	}

	//Data for output..
	$count = 0;
	$names = '';

	$ziggeo = new Ziggeo(APP_TOKEN, PRIVATE_KEY);

	$c = count($_FILES['files']['name']);

	for($i = 0; $i < $c; $i++) {

		//Setting up the arguments to pass over.. of course we can do this differently, this is just for example, but remember that each video has a different name while other parameters would be shared!
		$tmp_arguments = $arguments;
		$tmp_arguments['file'] = $_FILES['files']['tmp_name'][$i];

		//the actual passing of the videos to Ziggeo from our PC / Mac
		$ziggeo->videos()->create($tmp_arguments);

		//This is just for display purposes upon the upload
		$count++;
		$names .= '<li>' . $_FILES['files']['name'][$i] . '</li>';
	}

	?><!DOCTYPE html>
		<html>
			<head>
				<title>Finished - Ziggeo PHP SDK and multiple video file uploading</title>
			</head>
			<body>
				<p><?php echo $count ?> Video files have been uploaded to your Ziggeo account</p>
				<?php
					if($names !== '') {
						?>
						<ul><?php echo $names; ?></ul>
						<?php
					}
				?>
			</body>
		</html>
	<?php

	exit;
}


?><!DOCTYPE html>
<html>
	<head>
		<title>Ziggeo PHP SDK and multiple video file uploading</title>
		<!-- CSS to have the sample look neat so it is not needed for this to work -->
		<style type="text/css">
			html, body {
				margin: 0;
				padding: 0;
				width: 100%;
				font-family: Arial;
				font-size: 14px;
			}
			form {
				display: block;
				margin: auto;
				width: 500px;
			}
			label {
				display: block;
				margin-top: 2em;
			}
			input, textarea {
				border: 1px solid lightblue;
				border-radius: 6px;
				font-size: 16px;
				padding: 4px;
			}
			input:focus, textarea:focus {
				box-shadow: 0 0 8px lightblue;
			}
			button {
				background-image: linear-gradient(lightBlue, blue);
				border: 3px outset lightgray;
				border-radius: 20px;
				color: white;
				display: block;
				font-weight: bold;
				height: 40px;
				margin: 40px;
			}
			button:hover {
				background-image: linear-gradient(blue, lightBlue);
				border-style: inset;
				color: lightblue;
			}
		</style>
	</head>
	<body>
		<!-- this could be used to push single files to server with Ziggeo PHP SDK or to set up flash to push multiple files instead with just few slight changes.. -->
		<form method="POST" action="" enctype="multipart/form-data">
			<input name="submitted" type="hidden" value="submitted">
			<p>This is a basic demo on using the power of Ziggeo SDK to upload multiple videos to Ziggeo in bulk</p>
			<label for="files">Choose the video files that you would like to upload to your server..</label>
			<input name="files[]" type="file" multiple>

			<label for="tags">Tags allow you to filter queries by tags. Specify them as comma-separated list.</label>
			<input name="tags" id="tags" type="text" placeholder="(Optional)">

			<button>Submit videos</button>
		</form>
	</body>
</html>