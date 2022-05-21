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
        In the Admin Company Section.....
    </div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Logo</td>
                <td>Website</td>

            </tr>
        </thead>

        <body>


                <tr>
                    <td>{{ $company->name }} </td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->logo }} </td>
                    <td>{{ $company->website }} </td>

                </tr>







        </body>
    </table>

    <br><br>
    <div style="width: 500px;">
            <form method="POST" action="{{ route('add.user.company', $company->id) }}">
                @csrf
            <select name="abc" class="form-control">
               @foreach ($newComers as $newComer)
                <option value="{{ $newComer->id }}">{{$newComer->name}}</option>
              @endforeach
              </select>
              <br>
              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add New User') }}
                    </button>
                </div>
            </div>
              <br>
        </form>
    </div>

    <h2>Users </h2>
   {{--  <a href="{{ route('user.add') }}"> Create </a></h2> --}}
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>company</td>


            </tr>
        </thead>

        <body>



                @foreach ($users as $user)

                    <tr>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->email }}</td>
                        <td>

                            <form action="{{ route('delete.user.company',['id'=>$company->id , 'user_id'=>$user->user_id]) }} " method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit"> Delete</button>
                            </form>
                        </td>

                    </tr>

                @endforeach

        </body>
    </table>
    {{ $users->links() }}
    <a class="logout-btn btn btn-outline-light" href="{{ route('logout') }}">Logout</a>


</body>

</html>
@endsection
