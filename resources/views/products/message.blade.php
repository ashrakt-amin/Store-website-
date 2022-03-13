@extends('categories.layout')
@section('content')


<table class="table table-bordered  text-center">
    <tr>

        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>

    </tr>
    @forelse ($contacts as $contact)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$contact->users->name}}</td>
        <td>{{$contact->users->email}}</td>
        <td>{{$contact->message}}</td>
    
    </tr>

      @empty
      <tr>
        <td colspan="9">No Message</td>
      </tr>
      @endforelse

    </table>    

    
@endsection