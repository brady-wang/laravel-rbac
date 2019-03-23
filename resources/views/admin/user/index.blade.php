@extends("admin.layouts.main")

@section("content")

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            用户管理
            <small>用户列表</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="{{ url('/admin/user/add') }}">添加用户</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>id</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>状态</th>
                                <th>角色</th>
                                <th>操作</th>
                            </tr>
                            @foreach($data as $v)

                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>
                                        @if($v->status == 1)
                                            启用
                                        @else
                                            不可用
                                        @endif

                                    </td>
                                    <td>{{ $v->role_name }}</td>
                                    <td><a data-id="{{$v->id}}" href="{{ url('/admin/user/add',['id'=>$v->id]) }}" class=""> 编辑</a> <a data-id="{{ $v->id }}" href="javascript:void(0);" class="del" style="pointer:cursor;">删除</a></td>
                                </tr>

                                @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->


            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@push("scripts")
<script>

    $('.del').click(function(){
        var obj = $(this);
        layer.confirm("确认删除？",function(index){
            var del_id = obj.attr('data-id');
            console.log(del_id);
            var data = {'id':del_id};
            layer.close(index);

            var url = "{{url('/admin/user/del')}}";
            console.log(url);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type:'post',
                data:data,
                url:url,
                dataType:'json',
                success:function(res){
                    if(res.success == true){
                        console.log(res);
                        layer.msg(res.msg);
                        var location_url = '{{ url("/admin/users")}}';
                        setTimeout("location.href='"+location_url+"';",2000);
                    } else {
                        layer.msg(res.msg);
                    }
                }
            })
        })

    })

</script>

@endpush

@endsection