<!-- index -->
@extends('mails.frame')
@section('body-content')


        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    增加新邮件
</button>

<div class="row">
    <table class="table">
        <tr>
            <th>
                {{ trans('mails.' . 'id') }}
            </th>
            <th>
                {{ trans('mails.' . 'title' ) }}
            </th>
            <th>
                {{ trans('mails.' . 'contents') }}
            </th>
            <th>
                {{ trans('mails.' . 'time') }}
            </th>
            <th>
                {{ trans('mails.' . 'operation') }}
            </th>
        </tr>
        @foreach($mails as $mailId=>$mail)
            <tr>
                <td>
                    {{ isset($i)? ++$i: $i = 1 }}
                </td>
                <td>

                    {{ $mail['title'] }}
                </td>
                <td>
                    {{ $mail['content'] }}
                </td>
                <td>
                    {{ date('Y-m-d H:i:s',$mail['sendtime']) }}
                </td>
                <td>
                    <a href="/gmtools/delSystemMail/{{ $mailId }}">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/gmtools/SendSystemMail" method="POST">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">增加新邮件</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>
                            标题
                        </label>
                        <input class="form-control" type="text" name="title" placeholder="邮件标题">
                    </div>
                    <div class="form-group">
                        <label>
                            内容
                        </label>
                            <textarea class="form-control" type="text" name="context" placeholder="邮件内容"
                                      rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">放弃</button>
                    <button type="submit" class="btn btn-primary">增加</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

