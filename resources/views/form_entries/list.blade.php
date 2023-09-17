@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-5">Form Entries</h2>

        <table class="table">
            <caption>Form entries listing</caption>
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
                    <img src="{{ $entry->attachment }}"
                        alt="Attachment"
                        class="rounded img-thumbnail"
                        style="width: 200px;">
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
