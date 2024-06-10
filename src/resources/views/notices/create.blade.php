@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Create Notice</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" method="POST" action="{{ route('notices.store') }}"
                                            style=" width:90% ">
                                            @csrf
                                            <div class="form-group">
                                                <label for="content">Content</label></br><br>

                                                <textarea id="content" type="text"
                                                    class="form-control @error('content') is-invalid @enderror"
                                                    name="content" value="{{ old('content') }}" required autocomplete="content"
                                                    autofocus></textarea>
                                                    <br>
                                                <div class="col-md-12 error">
                                                    @error('content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                    </div>
                                    <br><br>
                                    <div class="form-group mb-0">

                                        <button type="submit" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                            style="width: 100px;">
                                            Submit
                                        </button>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
