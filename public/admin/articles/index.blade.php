@extends('admin.app')
@section('content')
    <div class="article-tabs">
        <ul>
            <li @if(!Input::get('partner'))class="active"@endif>
                <a href="{{action('Admin\ArticlesController@index')}}">GBTimes Articles</a>
            </li>
            <li @if(Input::get('partner') == 1)class="active"@endif>
                <a href="{{action('Admin\ArticlesController@index','partner=1')}}">Curated Content</a>
            </li>
            <li @if(Input::get('partner') == 2)class="active"@endif>
                <a href="{{action('Admin\ArticlesController@index','partner=2')}}">User Generated Content</a>
            </li>
        </ul>
    </div>
<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('all.records') }}
        <a href="{{ action('Admin\ArticlesController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('all.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        @include('admin.articles.filter')
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#ID</th><th>{{trans('all.title')}}</th><th>{{trans('all.category')}}</th><th>{{trans('all.type')}}</th><th>{{trans('all.author')}}</th><th>{{trans('all.published')}}</th><th>{{trans('all.status')}}</th><th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td><a href="{{ action('Admin\ArticlesController@edit',$article->id) }}" class="col-lg-11" @if($article->status==0)style="color:red;"@endif>{{ (trans('all.'.$article->title) != 'all.'.$article->title) ?  trans('all.'.$article->title) : $article->title}}</a></td>
                <td>{{join(',',array_pluck($article->categories->toArray(),'name'))}}</td>
                <td>{{$article->type}}</td>
                <td>{{ $article->author }}</td>
                <td>{{ $article->published_at }}</td>
                <td align="center"><a class="article-status" data-route="{{ action('Admin\ArticlesController@active',$article->id) }}" data-token="{{csrf_token()}}">{!! ($article->status == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</a></td>
                <td>
                    <a href="{{ action('Admin\ArticlesController@edit',$article->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a class="remove-modal" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\ArticlesController@destroy',$article->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <?php $get_partner = (Input::get('partner')) ? ['partner'=>1] : [];?>
                <td colspan="6" align="center">{!! str_replace('/?', '?', $articles->appends($get_partner)->render()) !!}</td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@include('admin.modals.remove',['item'=>trans('articles.sure')])
@stop