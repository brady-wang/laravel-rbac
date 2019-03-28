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

                                @if(!empty($role))
                                    <div class="form-group">
                                        <label for="name">ID</label>
                                        <input type="text" class="form-control" value="{{ $role->id }}" id="id" placeholder="ID" disabled="disabled" maxlength="50">
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputEmail1">角色名称</label>
                                    <input type="text" class="form-control" value="@if(!empty($role)){{ $role->name }}@endif" id="name" placeholder="请输入角色名称" maxlength="50">
                                </div>

                                <div class="form-group">
                                    <table class="table table-hover">

                                        <tr align="left">
                                            <th>菜单</th>
                                            <th>权限</th>
                                        </tr>

                                        @foreach($access as $v)
                                            <tr>
                                                <td>{{ $v['name'] }}</td>
                                                <td>
                                                    @if(isset($v['urls']))
                                                        <label>{{ $v['name'] }}<input type="checkbox" name="urls" value="{{ $v['urls'] }}" @if(isset($role->urls) && !is_null($role->urls) && in_array($v['urls'], $role->urls)) checked="checked" @endif /> </label>
                                                    @endif

                                                    @if(isset($v['subMenu']) && !empty($v['subMenu']))
                                                        @foreach($v['subMenu'] as $vv)
                                                            <label>{{ $vv['name'] }}<input type="checkbox" value="{{ $vv['urls'] }}" name="urls"   @if( isset($role->urls) &&  !is_null($role->urls) && in_array($vv['urls'],$role->urls)) checked="checked" @endif /> </label>

                                                        @endforeach
                                                    @endif

                                                </td>
                                            </tr>

                                        @endforeach

                                    </table>

                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="status" checked="@if(!empty($role) && $role->status == 1){{ "checked" }}@endif">状态
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
                   var id = $("#id").val();
                   var name = $.trim($("#name").val());
                   var status = $("#status").is(':checked');
                   var urls = [] ;
                   $("input:checkbox[name='urls']:checked").each(function(){
                       urls.push($(this).val())
                   });
                   status = status ? 1 : 0;
                   if(name.length == 0){
                       layer.msg('请填写角色名称');
                       return ;
                   }
                   var data = {};
                   data.id = id;
                   data.name = name;
                   data.status = status;
                   data.urls = urls;
                   console.log(urls);

                   var url = "{{ url('/admin/role') }}";
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                   $.ajax({
                     type:'POST',
                       data:data,
                       url:url,
                       dataType:'json',
                        success:function(res){
                            if(res.success == true){
                                console.log(res);
                                layer.msg("添加成功");
                                var location_url = '{{ url("/admin/roles")}}';
                                setTimeout("location.reload();",2000);
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