$(document).ready(function(){
	getItems();
	$(".phone").mask("+375(99)9999999");

});

//request to api.php (create Item)
$('.add_item_btn').on('click', function(){
	$.ajax({
	    url: 'api.php',
	    type: 'POST',
	    data: {
	    	action : 'addItem',
			token : '7f03972abba0972f81a203321fa4a7ba',
			name : $('.username').val(),
			phone : $('.phone').val()
	    },
	    success: function(response) {
	    	if (response.split('|')[0] == "input error")
	    		alert(response.split('|')[1]);
	    	else
	        	$('.table').html(response);
	    }
	});
});

//request to api.php (delete Item)
function deleteItem(itemId){
	$.ajax({
	    url: 'api.php',
	    type: 'POST',
	    data: {
	    	action : 'deleteItem',
			token : '7f03972abba0972f81a203321fa4a7ba',
			id: itemId
	    },
	    success: function(response) {
	        $('.table').html(response);
	    }
	});
}

//request to api.php (update Item)
function updateItem(itemId){
	$.ajax({
	    url: 'api.php',
	    type: 'POST',
	    data: {
	    	action : 'updateItem',
			token : '7f03972abba0972f81a203321fa4a7ba',
			name: $('.uName_'+itemId).val(),
			phone: $('.uPhone_'+itemId).val(),
			id: itemId
	    },
	    success: function(response) {
	        if (response.split('|')[0] == "input error")
	    		alert(response.split('|')[1]);
	    	else
	        	$('.table').html(response);
	    }
	});
}

function getItems(){
	$.ajax({
	    url: 'api.php',
	    type: 'GET',
	    data: {
	    	action : 'getItems',
			token : '7f03972abba0972f81a203321fa4a7ba'
	    },
	    success: function(response) {
	        $('.table').html(response);
	    }
	});
}

function getItemById(itemId){
	$.ajax({
	    url: 'api.php',
	    type: 'GET',
	    data: {
	    	action : 'getItemById',
			token : '7f03972abba0972f81a203321fa4a7ba',
			id : itemId
	    },
	    success: function(response) {
			$('.item_data').html(response);
	    }
	});
}

//show item details
function showItem(itemId){
	getItemById(itemId);
	$('.popup_frame').css('display', 'block');
}

$('.close_popup').on('click', function(){
	$('.popup_frame').css('display', 'none');
});
