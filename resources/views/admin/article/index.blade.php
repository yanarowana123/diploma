@extends('admin.layouts.app')

@section('content')
    <div>
        {{--        <div class="form-group">--}}
        {{--            <form action="" method="get" id="no-livewire__form">--}}
        {{--                <label for="title">Поиск</label>--}}
        {{--                <input type="text"--}}
        {{--                       name="title"--}}
        {{--                       class="form-control no-livewire"--}}
        {{--                       id="search-input"--}}
        {{--                       value="{{request('title')}}"--}}
        {{--                >--}}

        {{--            </form>--}}
        {{--        </div>--}}

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between mt-3">
                    <h2>Articles</h2>
                    <a href="{{route('admin.article.create')}}" class="btn btn-success mb-2">Add</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($articles as $index=>$article)
                            <tr>
                                <th scope="row"><a href="{{route('admin.article.edit',$article)}}">{{++$index}} </a>
                                </th>
                                <td>
                                    <a href="{{route('admin.article.edit',$article)}}">{{$article->title}}</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.article.edit',$article)}}">{{$article->created_at->format('d.m.Y H:i')}}</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.article.edit',$article)}}"><i
                                            class="fa fa-pen fa-fw"></i></a>
                                </td>
                                <td><a onclick="return confirm('Are you sure?')"
                                       href="{{route('admin.article.delete',$article)}}"><i
                                            class="fa fa-trash fa-fw"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="card-footer">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
