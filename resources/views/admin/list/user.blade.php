@extends('admin.index')
@section('title', '- Danh sách người dùng')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh sách người dùng
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $t = ($users->currentPage() - 1) * $users->perPage() + 1; ?>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$t++}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="{{route('edit.user', $user->name)}}" class="btn bg-green-600 btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('delete.user', $user->name)}}" class="btn bg-red-600 btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
{{--                <nav aria-label="Page navigation example">--}}
{{--                    <ul class="pagination">--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="{{$users->previousPageUrl()}}" aria-label="Previous">--}}
{{--                                <span aria-hidden="true">«</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="{{$users->nextPageUrl()}}" aria-label="Next">--}}
{{--                                <span aria-hidden="true">&raquo;</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
            </div>
        </div>
    </div>
@endsection
