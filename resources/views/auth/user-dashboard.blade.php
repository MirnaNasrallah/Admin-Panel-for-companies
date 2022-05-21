
@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <div class="container">
        <br>

        <br>
        Welcome, {{ \Auth::user()->name }} <br>
        In your Dashboard.....
    </div>
    <h2>  </h2>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Company</td>

            </tr>
        </thead>

        <body>


                <tr>
                    <td>{{ Auth()->user()->name }} </td>
                    <td>{{ Auth()->user()->email  }}</td>

                    <td>{{ DB::table('user_company')
                    ->where('user_id',Auth()->user()->id)
                    ->join('companies','companies.id','=','user_company.company_id')
                    ->pluck('name')->toArray()[0] ?? 'Empty' }}  </td>

                    <td><a href="{{ route('user.edit', Auth()->user()->id) }} ">edit</a> </td>
                </tr>

        </body>
    </table>

    <a  href="{{ route('logout') }}">Logout</a>

</body>


</html>
@endsection
