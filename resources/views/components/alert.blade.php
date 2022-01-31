@if (session()->has('message'))
<div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('message') }}
</div>
@endif

@if (session()->has('message-error'))
<div class="alert alert-danger" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('message-error') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-warning" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif
