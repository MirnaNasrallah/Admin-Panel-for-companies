@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Admin Auth - laravelcode.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
</head>

<body>

    <div class="container">
        Welcome, {{ \Auth::user()->name }} <br>
        In the Admin Dashboard.....
    </div>
    <h2> {{ $title }} <a href="{{ route('companies.create') }}"> Create </a></h2>
    <table>


        <body>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Logo</td>
                    <td>Website</td>

                </tr>
            </thead>

            <body>
                @foreach ($companies as $company)

                    <tr>
                        <td>{{ $company->name }} </td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->logo }} </td>
                        <td>{{ $company->website }} </td>
                    <td><a href="{{ route('companies.edit', $company->id) }} ">edit</a> </td>
                    <td>
                        <form action="{{ route('companies.destroy', $company->id) }} " method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"> Delete</button>
                        </form>
                    </td>
                    <td><a href="{{ route('view.user.company', $company->id) }} ">view empolyees</a> </td>


                </tr>
            @endforeach
        </body>
    </table>
    <a class="logout-btn btn btn-outline-light" href="{{ route('logout') }}">Logout</a>


</body>

</html>
@endsection
