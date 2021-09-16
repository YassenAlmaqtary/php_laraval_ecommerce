@extends('layouts.vendor')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            </li>
                            <li class="breadcrumb-item"><a href="#">  تعديل صور المنتجات </a>
                            </li>
                            <li class="breadcrumb-item active"> تعديل صورة - {{$name_product}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">تعديل صور المنتجات </h4>
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
                            @include('vendor.includes.alerts.success')
                            @include('vendor.includes.alerts.errors')
                            

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('vendor.photo.update',$photos->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                       
                                       {{-- <input type="hidden" value="{{$photos->path}}" id="id"  name="path">--}}
                                    
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img
                                                    src="{{get_url_image($photos->path)}}"
                                                    class="rounded-circle  height-150" alt="صورة القسم  ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> صورة المنتجات </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo" value="{{$photos->path}}">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
               
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>

</div>


@endsection