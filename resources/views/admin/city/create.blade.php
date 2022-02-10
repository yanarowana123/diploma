@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif
    <div class="card">

        <form method="POST" action="{{route('admin.city.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="label required" for="name">
                        Name
                    </label>

                    <div class="control">
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="name"
                               id="name"
                               value="{{old('title')}}"
                               required>
                    </div>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="label required" for="alt_name">
                        alt_name
                    </label>

                    <div class="control">
                        <input type="text"
                               class="form-control @error('alt_name') is-invalid @enderror"
                               name="alt_name"
                               id="alt_name"
                               value="{{old('alt_name')}}"
                               required>
                    </div>
                    @error('alt_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label required" for="lon">
                        lon
                    </label>

                    <div class="control">
                        <input type="text"
                               class="form-control @error('lon') is-invalid @enderror"
                               name="lon"
                               id="lon"
                               value="{{old('lon')}}"
                               required>
                    </div>
                    @error('lon')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label required" for="lat">
                        lat
                    </label>

                    <div class="control">
                        <input type="text"
                               class="form-control @error('lat') is-invalid @enderror"
                               name="lat"
                               id="lat"
                               value="{{old('lat')}}"
                               required>
                    </div>
                    @error('lat')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="card-footer">
                    <div class="form-group">
                        <div class="control">
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });


            CKEDITOR.replace('mytextarea', {
                filebrowserUploadUrl: "/admin/upload",
                filebrowserUploadMethod: 'form'
            });
        })
    </script>
@endpush
