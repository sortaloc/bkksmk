@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <script type="text/javascript">
            $(document).ready(function() {
                swal('Errors', '{{ $error }}', 'error');
            });
        </script>
    @endforeach
@endif

@if(session('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            swal('Success', '{{ session('success') }}', 'success');
        });
    </script>
@endif

@if(session('error'))
    <script type="text/javascript">
        $(document).ready(function() {
            swal('Error', "{{ session('error') }}", 'error');
        });
    </script>
@endif

@if(session('warning'))
    <script type="text/javascript">
        $(document).ready(function() {
            swal('Warning', "{{ session('warning') }}", 'warning');
        });
    </script>
@endif
