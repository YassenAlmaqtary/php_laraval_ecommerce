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
                            <li class="breadcrumb-item"><a href="{{route('vendor.photo.create')}}">  اضافة صور المنتجات </a>
                            </li>
                            <li class="breadcrumb-item active">  اضافة صور المنتجات
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
                                <h4 class="card-title" id="basic-layout-form"> اضافة صور المنتجات </h4>
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
                                    <form class="form" action="{{route('vendor.photo.store')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                       
                                        @csrf
                                    
                                    
                                        </div>
                                        <div class="form-group">
                                            <label> صورة المنتجات </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo" value="">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2"> أختر المنتجات </label>
                                                <select name="product" class="select2 form-control">
                                                    <optgroup label=" من فضلك اختر منتجاتك">
                                                        @if($Products && $Products-> count() > 0)
                                                            @foreach($Products as $product)
                                                                <option
                                                                    value="{{$product->id }}">{{$product->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error('product')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> اضافة
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