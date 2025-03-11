
		<script src="{{ asset('assets/js/plugins.js') }}"></script>
		<script src="{{ asset('assets/js/designesia.js') }}"></script>
		<script src="{{ asset('assets/js/swiper.js') }}"></script>
		<script src="{{ asset('assets/js/custom-marquee.js') }}"></script>
		<script src="{{ asset('assets/js/custom-swiper-1.js') }}"></script>
		<script src="{{ asset('assets/js/collapsible.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
		<script>
			$(function () {
			  $("#date").datepicker({
					autoclose: true,
					todayHighlight: true
			  }).datepicker('update', new Date());
			});

		</script>
