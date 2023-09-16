@extends('layouts.app')

@section('content')
<p class="lead">Form Entries</p>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Attachment</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($entries as $entry)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $entry->first_name }}</td>
      <td>{{ $entry->last_name}}</td>
      <td>
        <img src="{{ $entry->attachment }}" alt="Attachment" class="rounded img-thumbnail" style="width: 200px;">
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection