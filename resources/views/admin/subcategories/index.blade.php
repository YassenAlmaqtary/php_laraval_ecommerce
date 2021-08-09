@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الاقسام الفرعية </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الاقسام الفرعية
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع الاقسام الفرعية </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead>
                                        <tr>
                                            <th>السم الفرعي</th>
                                            <th>اللغة</th>
                                            <th>الحالة</th>
                                            <th>صوره </th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @isset($sub_categories)
                                            @foreach($sub_categories as $sub_categorie)  
                                
                                                <tr>
                                                    <td>{{$sub_categorie->name}}</td>
                                                    <td>{{$sub_categorie->translation_lang}}</td>
                                                    <td>{{$sub_categorie->getActive()}}</td>
                                                    <td><img style="width: 150px; height: 100px;" src="{{get_url_image($sub_categorie->photo)}}"></td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <a href="{{route('admin.sub-cstegorys.edit',$sub_categorie->id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                            <a href="" onclick="event.preventDefault();
                                                            document.getElementById('form').submit();" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> حذف </a>
                                                              
                                                            <form id="form" action="{{route('admin.sub-cstegorys.delete',$sub_categorie->id)}}" method="POST" class="d-none">
                                                                @method('delete')
                                                                @csrf
                                                            </form>

                                                            <a href=""
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                 @if($sub_categorie->active == 0)
                                                                     تفعيل
                                                                     @else
                                                                     الغاء تفعيل
                                                                 @endif
                                                             </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endisset
                                        </tbody> 
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

    
@endsection