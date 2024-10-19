		
		<script src="{{ asset('assets/js/plugins.js') }}"></script>
		<script src="{{ asset('assets/js/designesia.js') }}"></script>
		<script src="{{ asset('assets/js/swiper.js') }}"></script>
		<script src="{{ asset('assets/js/custom-marquee.js') }}"></script>
		<script src="{{ asset('assets/js/custom-swiper-1.js') }}"></script>

		<script>
			$(function () {
			  $("#date").datepicker({ 
					autoclose: true, 
					todayHighlight: true
			  }).datepicker('update', new Date());
			});
		
		</script>