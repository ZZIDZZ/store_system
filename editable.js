$(document).ready(function(){
	$('#product_list').Tabledit({
		eventType:'click',
		deleteButton: false,
		editButton: false,   		
		columns: {
		  identifier: [0, 'id'],                    
		  editable: [[2, 'product_name'], [3, 'product_price'], [4, 'product_discount']]
		},
		hideIdentifier: false,
		url: 'save_edit.php'		
	});
});