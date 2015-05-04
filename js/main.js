/**
 * Game Of Life
 *
 * @author     Alejandro Franco Rojas <alejandro.f.rojas@gmail.com>
 */
$(document).ready(function() {
	$(".cell").click(function(event){
		$(event.target).toggleClass("live");
		if($(event.target).hasClass("live")){
			$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).val(1);
			$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).attr("checked",true);
		} else {
			$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).val(0);
			$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).attr("checked",false);
		}
	});
	
	$(".reset").click(function(event){
		$(".cell").removeClass('live');
		$(".cell-input").val(0);
		$(".cell-input").attr("checked",false);
	});

	$(".step").click(function(event){
		$.ajax({
			method:"GET",
			url:"board.php",
			data:$("#form_board").serialize()
		}).done(function(msg){
			$('.board').html(msg);
			$(".cell").click(function(event){
				$(event.target).toggleClass("live");
				if($(event.target).hasClass("live")){
					$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).val(1);
					$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).attr("checked",true);
				} else {
					$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).val(0);
					$("#input_"+$(event.target).data("x")+"_"+$(event.target).data("y")).attr("checked",false);
				}
			});
		});
	});
});
