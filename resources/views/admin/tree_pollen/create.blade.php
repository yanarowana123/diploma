@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif
    <div class="card">

        <form method="POST" action="{{route('admin.tree_pollen.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="label required" for="title">
                        Title
                    </label>

                    <div class="control">
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               id="title"
                               value="{{old('title')}}"
                               required>
                    </div>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label required" for="title">
                        Level
                    </label>

                    <div class="control">
                        <input type="number"
                               class="form-control @error('tree_level') is-invalid @enderror"
                               name="tree_level"
                               id="tree_level"
                               value="{{old('tree_level')}}"
                               required>
                    </div>
                    @error('tree_level')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <textarea id="mytextarea" name="description">{{old('description')}}</textarea>

                <select class="form-control mt-2" name="city_id" id="city_id">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>

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
