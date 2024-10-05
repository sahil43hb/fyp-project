@extends('admin.layouts.master')

@section('title')
AgileSole - Users
@endsection

@section('css')

@endsection

@section('content')

        <table id="user_table" class="display text-center">
            <thead>
                <tr>
                    <th class="text-center !important">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
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