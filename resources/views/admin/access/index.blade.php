@extends("admin.layouts.main")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                权限管理
                <small>权限列表</small>
            </h1>

        </section>

        <section class="content">

            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>


                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">

                                <tr align="left">
                                    <th>菜单</th>
                                    <th>权限</th>
                                </tr>

                                @foreach($access as $v)
                                    <tr>
                                        <td>{{ $v['name'] }}<input type="checkbox" /></td>
                                        <td>
                                            @if(isset($v['urls']))
                                                <label>{{ $v['name'] }}<input type="checkbox" name="urls" value="{{ json_encode($v['urls']) }}" /> </label>
                                            @endif

                                            @if(isset($v['subMenu']) && !empty($v['subMenu']))
                                                @foreach($v['subMenu'] as $vv)
                                                        <label>{{ $vv['name'] }}<input type="checkbox" value="{{ json_encode($vv['urls']) }}" name="urls" /> </label>

                                                @endforeach
                                            @endif

                                        </td>
                                    </tr>

                                @endforeach


                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    @push("scripts")

    @endpush

@endsection