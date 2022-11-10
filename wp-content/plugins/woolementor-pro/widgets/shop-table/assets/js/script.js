jQuery(function($){
	$(document).on('change','.wl-st-qty',function(e){
		var $this = $(this)
		var $par = $this.parent()
		var qty = $this.val()
		$('.add_to_cart_button', $par).attr('data-quantity', qty)

		//for multiple add to cart
		var $grand_par = $par.parent().parent() 
		$( '.multiple_items .multiple_qty', $grand_par ).val( qty )
	})
})