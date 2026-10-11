@extends('backend.layouts.backendLayout')
@section('title', 'Robot')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Robot</h5>
                    <div class="card-body">
                        <form id="addRobotForm" class="is-invalid" novalidate action="{{ route('robot.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="robot_txt" class="form-label">Robot.txt</label>
                                <textarea class="form-control" id="robot_txt" name="robot_txt" rows="4"></textarea>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="d-flex justify-content-end">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script>
        var robotIndexUrl = "{{ route('admin.robot') }}";
        var robotStoreUrl = "{{ route('robot.store') }}";
    </script>
     <script src="{{ asset('assets/js/robot.js') }}"></script>
    @endsection