@extends("admin.layouts.main")

@section("content")

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户管理
                <small>用户新增</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">角色名称</label>
                                    <input type="text" class="form-control" id="name" placeholder="请输入角色名称" maxlength="50">
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="status" checked="checked">状态
                                    </label>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="add_role">提交</button>
                            </div>

                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    @push('scripts')
        <script>
            $(function(){
               $("#add_role").click(function(){
                   var name = $.trim($("#name").val());
                   var status = $("#status").is(':checked');
                   status = status ? 1 : 0;
                   if(name.length == 0){
                       layer.msg('请填写角色名称');
                       return ;
                   }
                   var data = {};
                   data.name = name;
                   data.status = status;


                   var url = "{{ url('/admin/role/doAdd') }}";
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                   $.ajax({
                     type:'post',
                       data:data,
                       url:url,
                       dataType:'json',
                        success:function(res){
                            if(res.success == true){
                                console.log(res);
                                layer.msg("添加成功");
                                var location_url = '{{ url("/admin/roles")}}';
                                setTimeout("location.href='"+location_url+"';",2000);
                            } else {
                                layser.msg(res.msg);
                            }
                        }
                   })
               })
            })
        </script>
    @endpush

@endsection