@extends('admin.master')

@section('title', '积分配置')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            积分配置
            <small>Score Options</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">积分换算</h3>
                    </div><!-- /.box-header -->
                    <form method="post" action="../admin/score">
                        <input type="hidden" name="option" value="rate">
                        <div class="box-body">
                            <?php
                            if (isset($_POST['option']) && ($_POST['option'] == "rate")) {
                                Option::set('score_per_storage', $_POST['score_per_storage']);
                                Option::set('score_per_player', $_POST['score_per_player']);
                                Option::set('user_initial_score', $_POST['user_initial_score']);
                                echo '<div class="callout callout-success">设置已保存。</div>';
                            } ?>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="key">存储</td>
                                        <td class="value">
                                           <div class="input-group">
                                               <input type="text" class="form-control" name="score_per_storage" value="{{ Option::get('score_per_storage') }}">
                                               <span class="input-group-addon">积分 = 1 KB</span>
                                           </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="key">角色</td>
                                        <td class="value">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="score_per_player" value="{{ Option::get('score_per_player') }}">
                                                <span class="input-group-addon">积分 = 一个角色</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="key">新用户默认积分</td>
                                        <td class="value">
                                            <input type="text" class="form-control" name="user_initial_score" value="{{ Option::get('user_initial_score') }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">签到配置</h3>
                    </div><!-- /.box-header -->
                    <form method="post" action="../admin/score">
                        <input type="hidden" name="option" value="sign">
                        <div class="box-body">
                            <?php
                            if (isset($_POST['option']) && ($_POST['option'] == "sign")) {
                                $sign_score = $_POST['sign_score_from'].','.$_POST['sign_score_to'];
                                Option::set('sign_score', $sign_score);
                                Option::set('sign_gap_time', $_POST['sign_gap_time']);
                                echo '<div class="callout callout-success">设置已保存。</div>';
                            } ?>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="key">签到获得积分</td>
                                        <td class="value">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="sign_score_from" value="{{ explode(',', Option::get('sign_score'))[0] }}">
                                            <span class="input-group-addon" style="border-right: 0; border-left: 0;">积分 ~ </span>
                                            <input type="text" class="form-control" name="sign_score_to" value="{{ explode(',', Option::get('sign_score'))[1] }}">
                                            <span class="input-group-addon">积分</span>
                                          </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="key">签到间隔时间</td>
                                        <td class="value">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="sign_gap_time" value="{{ Option::get('sign_gap_time') }}">
                                            <span class="input-group-addon">小时</span>
                                          </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection