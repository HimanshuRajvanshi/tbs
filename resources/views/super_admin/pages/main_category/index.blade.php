@extends('super_admin.layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               <div class="header">
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/list/main_category')}}"><button type="button" class="btn btn-info waves-effect m-r-20">Main Category List</button></a>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/assign_list/main_category')}}"><button type="button" class="btn btn-primary waves-effect m-r-20">Assign Main CategoryList</button></a>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/assign/main_category')}}"><button type="button" class="btn btn-primary waves-effect m-r-20">Assign Category</button></a>
                </div>
            </div>
            
                <div class="card">
                @include('layouts.errors')
                        
                        @if(Session::has('flash_message'))
                        <div class="alert alert-info"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                        @endif
                    <div class="header">
                        <h2>
                            Main Category List
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Main Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           @foreach($category as $key => $categories)
                            @php $key++;@endphp
                                <tr>
                                   <th scope="row">{{$key}}</th>
                                    <td>{{$categories->name}}</td>
                                    <td>
                                        @if($categories->status ==1)         
                                            <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal{{$categories->id}}">Active</button>
                                        @include('super_admin.pages.main_category.status')
                                        @else
                                            <button type="button" class="btn btn-danger waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal{{$categories->id}}">Deactive</button> 
                                            @include('super_admin.pages.main_category.status')       
                                        @endif
                                        </td>
                                        <td>    
                                            <button type="button" class="btn btn-info waves-effect m-r-20" data-toggle="modal" data-target="#Modal{{$categories->id}}">Edit</button>
                                            @include('super_admin.pages.main_category.edit_modal')
                                        </td>
                                </tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection