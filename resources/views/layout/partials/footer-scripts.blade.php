<!-- jQuery -->
		{{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
		<!-- Fancybox JS -->
		<script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
			<!-- circle progress JS -->
		<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
		<!-- Select2 JS -->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		<!-- Dropzone JS -->
		<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>

		<!-- Bootstrap Tagsinput JS -->
		<script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>

		<!-- Profile Settings JS -->
		<script src="{{ asset('assets/js/profile-settings.js') }}"></script>

		<!-- Datetimepicker JS -->
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<!-- Full Calendar JS -->
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fullcalendar/jquery.fullcalendar.js') }}"></script>
		<!-- Sticky Sidebar JS -->
        <script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
        @stack('script')
		<!-- Slick JS -->
		<script src="{{ asset('assets/js/slick.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            window.addEventListener('feedback',event => {
              toastr.success(event.detail.feedback);
            });

            window.addEventListener('errofeedback',event => {
              toastr.error(event.detail.errofeedback);
            });
         </script>
           @if(session('feedback'))
           <script>
               toastr.success('{{ session('feedback') }}');
           </script>
           @endif

           @if(session('errorfeedback'))
           <script>
               toastr.error('{{ session('errorfeedback') }}');
           </script>
           @endif

        @stack('script')
		<!-- Custom JS -->
		<script src="{{ asset('assets/js/script.js') }}"></script>
		@if(Route::is(['map-grid','map-list']))
		<script src="https://maps.googleapis.com/maps/api/js?key=MAPKEY"></script>
		<script src="{{ asset('assets/js/map.js') }}"></script>
		@endif --}}
		
		<script src="{{ asset('assets/js/plugins.js') }}"></script>
		<script src="{{ asset('assets/js/designesia.js') }}"></script>
		<script src="{{ asset('assets/js/swiper.js') }}"></script>
		<script src="{{ asset('assets/js/custom-marquee.js') }}"></script>
		<script src="{{ asset('assets/js/custom-swiper-1.js') }}"></script>