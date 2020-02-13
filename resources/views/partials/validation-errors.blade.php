@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Sorry!</strong> Tienes problemas con tu input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
