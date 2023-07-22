<!DOCTYPE html>
<html>
<head>
    <title>Dependent dropdown example</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
</head>
<body>
    <div>
        
        <div>
            {{ __('Customer') }} <br>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" id="secretary">
                <option selected disabled>{{ __('Select secretaries')}}</option>
                @foreach ($secretaries as $secretary)
                <option value="{{ $secretary->secretary_id }}">{{ $secretary->name }}</option>
                @endforeach
            </select>

            Texto seleccionado:<input type="text" id="customer_id" name="text1"><br>
        </div>
        <br>
        <div>
            {{ __('Contact') }} <br>
            Texto seleccionado:<input type="text" id="contact_id" name="text1"><br>
            <select class="form-select " id="undersecreatries"></select>
        </div>

        <div id="gestor">
            <select id="managements" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#secretary').on('change', function () {
                var countryId = $(this).val();
                //document.getElementById('customer_id').value= countryId;
                $('#undersecreatries').html('');
                $.ajax({
                    url: "{{ route('getUndersecretary') }}?secretary_id="+countryId,
                    type: 'get',
                    success: function (res) {
                        $('#undersecreatries').html("<option value=''>{{ __('Select contact')}}</option>");
                        $.each(res, function (key, value) {
                            $('#undersecreatries').append('<option value="' + value
                                .undersecretary_id + '">' + value.name  +'</option>');
                        });
                    }
                });
            });

            $('#undersecreatries').on('change', function () {
                var contactId = this.value;
                document.getElementById('contact_id').value= contactId;
                $('#managements').html('');
                $.ajax({
                            url: "{{ route('getManagements') }}?undersecretary_id="+contactId,
                            type: 'get',
                            success: function (res) {
                                $('#managements').html("<option value='0' selected disabled>{{ __('Select contact')}}</option>");
                                $.each(res, function (key, value) {
                                    $('#managements').append('<option value="' + value
                                        .management_id + '">' + value.name +'</option>');
                                });
                            }
                        });
            });
        });
    </script>
</body>
</html>