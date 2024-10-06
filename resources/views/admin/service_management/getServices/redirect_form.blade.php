<form id="redirectForm" action="{{ route('admin.getServices', [$id_ldv]) }}" method="POST">
    @csrf

    @if($success)
        <input type="hidden" name="success" value="{{ $success }}">
    @endif

    @if($error)
        <input type="hidden" name="error" value="{{ $error }}">
    @endif
</form>

<script>
    document.getElementById('redirectForm').submit();
</script>


