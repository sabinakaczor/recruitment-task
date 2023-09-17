@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-5">Add a new entry</h2>
        <form enctype="multipart/form-data" method="POST" action="{{ route('formEntries.store') }}" id="add_entry_form">
            @csrf
            <div class="mb-3">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    placeholder="Enter first name">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    placeholder="Enter last name">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="attachment">Attachment</label>
                <input type="file" class="form-control" id="attachment" name="attachment">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="alert alert-success d-none" role="alert">
                The entry was successfully created!
            </div>
            <div class="alert alert-danger d-none" role="alert">
                An error occured!
            </div>
        </form>
    </div>
</div>
@endsection

@section('contextual-scripts')
<script>
    $(document).ready(function () {
        $('#add_entry_form').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const data = new FormData(form[0]);

            $.ajaxSetup({
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.alert-success').addClass('d-none');
                    $('.alert-danger').addClass('d-none');
                    $('input').removeClass('is-invalid');
                },
                error: function (data) {
                    if (data.status == 422) {
                        const errors = data.responseJSON.errors;
                        for (const field in errors) {
                            $(`[name=${field}]`)
                                .addClass('is-invalid')
                                .siblings('.invalid-feedback')
                                .text(errors[field][0]);
                        }
                    } else {
                        $('.alert-danger').removeClass('d-none');
                    }
                }
            });
            $.post(
                $(this).attr('action'),
                data,
                function (data) {
                    $('.alert-success').removeClass('d-none');
                    form[0].reset();
                }
            );
        })
    });
</script>
@endsection
