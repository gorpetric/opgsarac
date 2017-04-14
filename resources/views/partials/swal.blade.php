@if(notify()->ready())
<script type="text/javascript">
swal({
    title: '{!! notify()->message() !!}',
    type: '{{ notify()->type() }}',
    @if(notify()->option('text'))
        text: '{!! notify()->option("text") !!}',
    @endif
    @if(notify()->option('timer'))
        timer: {{ notify()->option('timer') }},
    @endif
    @if(notify()->option('noConfirm'))
        showConfirmButton: false,
    @endif
});
</script>
@endif
