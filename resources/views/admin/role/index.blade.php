@extends("admin.layouts.main")

@section("content")

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            角色管理
            <small>角色列表</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="{{url('/admin/role/add')}}">新增</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>id</th>
                                <th>角色名称</th>
                                <th>用户数量</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            @foreach ($data as $v)
                                <tr>
                                    <td>{{ $v->id  }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>
                                        @if(isset($number[$v->id]))
                                        {{ $number[$v->id]->number }}</td>
                                        @endif
                                    {{ 0 }}
                                    <td>
                                        @if($v->status == 1)
                                            启用
                                        @else
                                            不可用
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/admin/role/add',['id'=>$v->id]) }}">编辑</a>||<a class="del" href = "javascript:void(0);" data-id = "{{ $v->id }}">删除</a></td>
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
           var url = "{{url('/admin/role/del')}}";
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
                       var location_url = '{{ url("/admin/roles")}}';
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