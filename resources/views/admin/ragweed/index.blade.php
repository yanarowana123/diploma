@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between mt-3">
                    <h2>Ragweed pollen</h2>
                    <a href="{{route('admin.dust.create')}}" class="btn btn-success mb-2">Add</a>
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
                        @if($articles->isNotEmpty())
                            @foreach($articles as $index=>$article)
                                <tr>
                                    <th scope="row"><a href="{{route('admin.ragweed.edit',$article)}}">{{++$index}} </a>
                                    </th>
                                    <td>
                                        <a href="{{route('admin.ragweed.edit',$article)}}">{{$article->title}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.ragweed.edit',$article)}}">{{$article->created_at?->format('d.m.Y H:i')}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.ragweed.edit',$article)}}"><i
                                                class="fa fa-pen fa-fw"></i></a>
                                    </td>
                                    <td><a onclick="return confirm('Are you sure?')"
                                           href="{{route('admin.ragweed.delete',$article)}}"><i
                                                class="fa fa-trash fa-fw"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
