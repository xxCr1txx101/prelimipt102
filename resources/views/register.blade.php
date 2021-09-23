@extends('base')

@section('content')
<br><br><br>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <div>
                <div>
                    <h1 style="text-align:center; color:#A7D129;">Registration Form</h1>
                </div>
<br>
                <div style="color:white;">
                    <form action="{{url('/register')}}" method="post">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button class="btn btn-success" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop