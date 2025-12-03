@extends('layouts.app')

@section('title', 'Team')

@section('content')
    <h2>Team Members</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($team as $member)
                <tr>
                    <td>{{ $member['name'] }}</td>
                    <td>{{ $member['role'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
