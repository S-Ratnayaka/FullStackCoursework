<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ajax demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body>
<div class="container">
<h1>Game search</h1>
<form class="row g-3">
<div class="col-auto">
<input type="text" class="form-control" id="searchBox" placeholder="Keywords">
</div>
</form>
<p id="results"></p>
</div>
</body>
</html>
<script>
// We "listen" for key pressed in our search box
document.getElementById("searchBox").addEventListener("keyup", doSearch);
// Function called when searching
function doSearch() {
// Get keyword from search box
keywords = document.getElementById("searchBox").value;
// Call server script, passing our keyword
fetch('https://mi-linux.wlv.ac.uk/~2432452/FullStack/ajax.php?search=' + keywords)
// Convert response string to json object
.then(response => response.json())
.then(response => {
// Clear result box
document.getElementById("results").innerHTML = '';
// Loop through data and add to result box
response.forEach(game => {
document.getElementById("results").append(game.game_name + ' ');
});
});
}
</script>