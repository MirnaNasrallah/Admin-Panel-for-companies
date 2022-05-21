@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Admin Auth - laravelcode.com</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
</head>

<body>

    <div class="container">
        Edit User Details
    </div>
    <h2> hello</h2>
    <form action="{{ route('user.update', Auth()->user()->id) }}" method="post">

        @csrf
        @method('put')
        <div>
            <label for="">  name </label>
            <input type="text" class="form-control" name="name" value="{{ Auth()->user()->name }}">
        </div>
        <div>
            <label for=""> Email </label>
            <input type="text" class="form-control" name="email" value="{{ Auth()->user()->email }}">
        </div>

        <div>
            <label for=""> Company : {{ DB::table('user_company')
                ->where('user_id',Auth()->user()->id)
                ->join('companies','companies.id','=','user_company.company_id')
                ->select('companies.name')
                ->pluck('name')->toArray()[0] }}</label>

        </div>
        <br><br>
        <div>
             <select name="abc" class="form-control">
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name}}</option>
              @endforeach
              </select>
        </div>
        <br><br>
        <div>
            <button type="submit">Submit</button>
        </div>

    </form>



</body>

</html>
@endsection
