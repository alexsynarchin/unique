
<script src="{{mix('js/app.js', 'assets/admin')}}?ver=26"></script>

<script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}
    }
</script>
