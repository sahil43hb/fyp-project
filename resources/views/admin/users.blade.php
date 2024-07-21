@extends('admin.layouts.master')

@section('title')
    FootStep - Users
@endsection

@section('css')

@endsection

@section('content')

        <table id="user_table" class="display text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
@endsection
@section('script')
@endsection