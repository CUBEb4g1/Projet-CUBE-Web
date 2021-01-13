

@push('scripts')
    <script>
        $(function() {

            // Récupération des id pour pays et ville
            var country_id = {{ old('country', $author->city->country->id) }};
            var city_id = {{ old('city', $author->city->id) }};

            // Sélection du pays
            $('#country').val(country_id).prop('selected', true);
            // Synchronisation des villes
            cityUpdate(country_id);

            // Changement de pays
            $('#country').on('change', function(e) {
                var country_id = e.target.value;
                city_id = false;
                cityUpdate(country_id);
            });

            // Requête Ajax pour les villes
            function cityUpdate(countryId) {
                $.get('{{ url('cities') }}/'+ countryId + "'", function(data) {
                    $('#city').empty();
                    $.each(data, function(index, cities) {
                        $('#city').append($('<option>', {
                            value: cities.id,
                            text : cities.name
                        }));
                    });
                    if(city_id) {
                        $('#city').val(city_id).prop('selected', true);
                    }
                });
            }

        });
    </script>
@endpush
