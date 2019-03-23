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
                            @if(!empty($user))
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" class="form-control" value="{{ $user->id }}" id="id" placeholder="ID" disabled="disabled" maxlength="50">
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="name">用户名</label>
                                <input type="text" class="form-control" value="@if(!empty($user)){{ $user->name }}@endif" id="name" placeholder="请输入用户名称" maxlength="50">
                            </div>

                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="text" class="form-control" value="@if(!empty($user)){{ $user->email }}@endif" id="email" placeholder="请输入用户邮箱" maxlength="50">
                            </div>

                            <div class="form-group">
                                <label>角色</label>
                                <select class="form-control" id="role">

                                    @foreach($roles as $v)
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                                </select>
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
                    var id = $("#id").val();
                    var name = $.trim($("#name").val());
                    var email = $.trim($("#email").val());
                    var status = $("#status").is(':checked');
                    var role = $("#role").val();

                    status = status ? 1 : 0;
                    if(name.length == 0){
                        layer.msg('请填写用户名称');
                        return ;
                    }

                    if(name.length == 0){
                        layer.msg('请填写邮箱');
                        return ;
                    }

                    var data = {};
                    data.id = id;
                    data.name = name;
                    data.email = email
                    data.status = status;
                    data.role_id = role;
                    console.log(data);


                    var url = "{{ url('/admin/user/doAdd') }}";
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