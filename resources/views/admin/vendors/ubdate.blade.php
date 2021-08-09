@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}">  تعديل بيانات التجار </a>
                            </li>
                            <li class="breadcrumb-item active"> تعديل - {{$vendor->name}}
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
                                <h4 class="card-title" id="basic-layout-form">تعديل بيانات التجار </h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.vendors.update',$vendor->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @method('put')
                                        @csrf

                                        <input type="hidden"  value="" id="latitude" name="latitude">
                                        <input type="hidden" value="" id="longitude"  name="longitude">
                                        <input type="hidden" value="{{$vendor->id}}" id="id"  name="id">
                                    
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img
                                                    src="{{get_url_image($vendor->logo)}}"
                                                    class="rounded-circle  height-150" alt="صورة القسم  ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> شعار التجار </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="logo" value="{{$vendor->logo}}">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('logo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات المتجر </h4>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> الاسم </label>
                                                        <input type="text" value="{{$vendor->name}}" id="name"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> أختر القسم </label>
                                                        <select name="main_categorie_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر القسم ">
                                                                @if($categories && $categories -> count() > 0)
                                                                    @foreach($categories as $category)
                                                                        <option
                                                                            value="{{$category->id }}">{{$category->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('main_categorie_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> رقم الهاتف </label>
                                                        <input type="text" id="mobile"
                                                               class="form-control"
                                                               placeholder=" " name="mobile" value="{{$vendor->mobile}}">

                                                        @error("mobile")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> ألبريد الالكتروني </label>
                                                        <input type="text" id="email"
                                                               class="form-control"
                                                               placeholder="  " name="email" value="{{$vendor->email}}">

                                                        @error("email")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة المرور  </label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   placeholder="" name="password" >

                                                            @error("password")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>

                                                </div>

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم الشركة </label>
                                                        <input type="text" id="company_name"
                                                               class="form-control"
                                                               placeholder="  " name="company_name" value="{{$vendor->company_name}}">

                                                        @error("company_name")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> العنوان  </label>
                                                        <input type="text" id="pac-input"
                                                               class="form-control"
                                                               placeholder="  " name="address" value="{{$vendor->address}}">

                                                        @error("address")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" value="1"
                                                               name="active"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               @if($vendor->active == 1)checked @endif/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">الحالة </label>

                                                        @error("active")
                                                        <span class="text-danger"> </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        {{--<div id="map" style="height: 500px;width: 1000px;"></div>--}}

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