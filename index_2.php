<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Find Grub</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<h1>Find Grub</h1>
	
		<form method="post" action="searchresults.php">
			<div class="city" id="city">
				<label>Search in city:</label>
				<input type="text" name="search__city">
			</div>
			<div>
				<label>Search for:</label>
				<input type="text" name="search__request" value="Look for restaurants">
			</div>
			<input type="submit" name="search__button" value="OK">
		</form>
	</body>
</html>