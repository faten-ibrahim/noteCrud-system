@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Edit Note</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ html()->modelForm($note, 'PUT', route('notes.update', [$note->id]))->open() }}
                                        {{ html()->textarea('content') }}
                                        {{ html()->submit($text = 'submit')}}

                                        {{ html()->closeModelForm() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
