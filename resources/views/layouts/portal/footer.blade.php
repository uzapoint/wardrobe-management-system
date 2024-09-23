                        <footer class="card content-footer footer bg-footer-theme">
                            <div class="container-xxl">
                                <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                    <div>
                                        © {{ date('Y') }}, All Rights Reserved <!-- <a href="https://pixinvent.com/" target="_blank" class="footer-link text-primary fw-medium">Pixinvent</a> -->
                                    </div>
                                </div>
                            </div>
                        </footer>

                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>

            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>

        @include('portal.users.edit')
        <script type="text/javascript" src="{{ url('custom/users/edit.js') }}"></script>

        @include('portal.users.reset-password')
        <script type="text/javascript" src="{{ url('custom/users/reset-password.js') }}"></script>

        <script type="text/javascript" src="{{ url('custom/js/jquery-3.3.1.js') }}"></script>
        <script type="text/javascript" src="{{ url('custom/js/form-validator.min.js') }}"></script>

        <script src="{{ url('portal/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ url('portal/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ url('portal/vendor/js/menu.js') }}"></script>

        <script src="{{ url('portal/vendor/libs/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/pickr/pickr.js') }}"></script>
        
        <script src="{{ url('portal/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>

        <script src="{{ url('portal/js/form-wizard-numbered.js') }}"></script>

        <script src="{{ url('portal/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

        <script src="{{ url('portal/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/tagify/tagify.js') }}"></script>

        <!-- <script src="{{ url('portal/vendor/libs/form-validation/popular.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/form-validation/bootstrap5.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/form-validation/auto-focus.js') }}"></script> -->
        <script src="{{ url('portal/js/form-validation.js') }}"></script>

        <script src="{{ url('portal/js/main.js') }}"></script>  
          
        <script src="{{ url('portal/js/dashboards-analytics.js') }}"></script>

        <script src="{{ url('portal/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ url('portal/js/forms-selects.js') }}"></script>

        <script src="{{ url('portal/js/forms-pickers.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ url('custom/smart-search/jquery-ui.min.js') }}" type="text/javascript"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYJIo4sYWC34XS0sbf2NLEgbVHw7kLbE8&libraries=places"></script>

        <script>
            $(window).on('load', function() 
            {
                $('.disabled-btn').css({
                    'pointer-events': 'auto',
                    'opacity': '1',
                    'cursor': 'pointer'
                });
            });
            
            document.addEventListener('DOMContentLoaded', function()
            {
                // Loop through each autocomplete input field
                $('.autocomplete').each(function (index, element) 
                {
                    // Create a new Autocomplete instance for each input field
                    var autocomplete = new google.maps.places.Autocomplete(element, 
                    {
                        componentRestrictions: { country: 'KE' }
                    });

                    // Store the index for each input
                    var currentInputIndex = $(element).data('guarantor-index');

                    // Event listener for when a place is selected
                    autocomplete.addListener('place_changed', function () 
                    {
                        var place = autocomplete.getPlace();
                        if(!place.geometry) 
                        {
                            alert("No details available for input: '" + place.name + "'");
                            return;
                        }

                        var latitude = place.geometry.location.lat();
                        var longitude = place.geometry.location.lng();

                        // Assign the latitude and longitude to the respective input fields
                        $('.latitude').val(latitude);
                        $('.longitude').val(longitude);
                    });
                });
        
                $('.number-format').keyup(function(event) 
                {
                    // skip for arrow keys
                    if(event.which >= 37 && event.which <= 40) return;

                    // format number
                    $(this).val(function(index, value) 
                    {
                        return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    });
                });

                //ALLOW INTEGERS ONLY----------------------------------
                $('.number_only').bind('keyup paste', function(){
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                $('.number_with_dot_only').bind('keyup paste', function() {
                    // Replace all non-numeric characters except a single dot
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    // Ensure only one dot is allowed in the input
                    if ((this.value.match(/\./g) || []).length > 1) {
                        this.value = this.value.slice(0, -1);
                    }
                });
            });
        </script>
    </body>
    </html>

