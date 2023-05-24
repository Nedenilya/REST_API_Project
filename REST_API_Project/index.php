<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/styles.css">
	<title>Test</title>
</head>
<body>
	<div class="container">
		<form class="add_item_form">
			<p>Add new Item</p>
			<label name="username">Name</label>
			<input class="username" required name="username" type="text">
			<label name="phone">Phone</label>
			<input class="phone" required name="phone" type="text">
			<input class="add_item_btn btn" type="button" value="Add Item">
		</form>

		<div class="show_items_block">
			<p>Items</p>
			<div class="table">
				<div class="table_row table_head">
					<div class="table_cell">Id</div>
					<div class="table_cell">Name</div>
					<div class="table_cell">Phone</div>
					<div class="table_cell">Show details</div>
					<div class="table_cell">Update</div>
					<div class="table_cell">Delete</div>
				</div>
			</div>
		</div>

		<div class="popup_frame">
			<p class="close_popup">x</p>
			<div class="item_data">
			</div>
		</div>

	</div>

</body>
<script type="text/javascript" src="assets/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript" src="assets/script.js"></script>
</html>