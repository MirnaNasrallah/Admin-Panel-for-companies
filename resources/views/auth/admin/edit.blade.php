@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Admin Auth - laravelcode.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container">
   Edit Company
</div>
<h2> hello admin</h2>
<form action="{{route('companies.update',$company->id)}}" method="post">

    @csrf
    @method('put')
    <div>
        <label for=""> Company name </label>
        <input type = "text" class="form-control" name="name" value="{{$company->name}}">
    </div>
    <div>
        <label for=""> Company Email </label>
        <input type = "text" class="form-control" name="email" value="{{$company->email}}">
    </div>
    <div>
        <label for=""> Company logo </label>
        <input type = "file" class="form-control" name="image">
    </div>
    <div>
        <label for=""> Company website </label>
        <input type = "text" class="form-control" name="website" value="{{$company->website}}">
    </div>
    <div>
        <button type="submit" >Submit</button>
    </div>

</form>



</body>
</html>
@endsection
