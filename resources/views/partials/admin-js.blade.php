<!-- Scripts  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>--}}

<script src="{{ asset('assets/admin/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pcoded.min.js') }}"></script>

<script src="{{ asset('assets/admin/fonts/fontawesome/js/fontawesome-all.min.js') }}"></script>


<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/admin/plugins/data-tables/js/datatables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>
<!-- End Datatables -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="{{ asset('assets/admin/js/custom.js') }}" defer></script>

<!-- Notie Library -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<script src="https://unpkg.com/notie"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!--toastr-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- sweetalert -->
<script type="text/javascript" src="{{ asset('assets/admin/js/sweet-alert/sweetalert2@9.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$( document ).ajaxError(function( event, response, settings ) {
			if(response.status == 401){
				window.location.href = "{{ route('admin.login') }}";
			}
		});
		$(document).on('shown.bs.modal', '.modal', function() {	
			$(this).find('[autofocus]').focus();

			// restrict modal to close from clicking outside
			$(this).data('bs.modal')._config.backdrop = 'static';
		});
		// add tooltip on btn class and have title
		$('body').tooltip({selector: 'a.label, .btn, .btn-checked', placement: 'bottom'});
		
		$(document).on('click', 'button, a', function() {	
			$('.tooltip').remove();
		});

		// Datatable global default configuration
		(function ($, DataTable) {
			$.extend(true, DataTable.defaults, {
				drawCallback : function() { 
								var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
								pagination.toggle(this.api().page.info().pages > 1); 
							},
				language: {
					"sEmptyTable": 'No record found',
				}
			});
		})(jQuery, jQuery.fn.dataTable);
		
	});
</script>