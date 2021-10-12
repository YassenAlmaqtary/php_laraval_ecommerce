@extends('layouts.vendor')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> منتجاتي </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                
                            <li class="breadcrumb-item active"> منتجاتي
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
                                <h4 class="card-title">بيانات منتجاتي</h4>
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
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead>
                                        <tr>
                                            <th> اسم المنتج </th>
                                            <th>الوصف</th>
                                            <th>السعر</th>
                                            <th>التخفيض</th>
                                            <th>اسم الشركة</th>
                                            <th>الكمية </th>
                                            <th>الحالة</th>
                                            <th>القسم الرئيسي </th>
                                            <th>القسم الفرعي </th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @isset($products)
                                             @foreach ($products as $product)
                                                <tr>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>{{$product->price}}</td>
                                                    <td>@if ($product->descount!=null)
                                                        {{$product->descount}}
                                                    @else
                                                        لايوجد تخفيظ
                                                    @endif</td>
                                                    <td>{{$product->vendor->company_name}}</td> 
                                                    <td>{{$product->quntity}}</td>
                                                    <td>{{$product->getActive()}}</td>
                                                    <td>{{$product->mainCategory->name}}</td> 
                                                    <td>{{$product->Subctegory->name}}</td>  
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <a href="{{route('vendor.product.edit',$product->id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                            <a href="" onclick="event.preventDefault();
                                                            document.getElementById('form').submit();" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> حذف </a>
                                                              
                                                            <form id="form" action="{{route('vendor.product.delete',$product->id)}}" method="POST" class="d-none">
                                                                @method('delete')
                                                                @csrf
                                                            </form>

                                                            <a href="{{route('vendor.photo.show',$product->id)}}"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                               عرض صور المنتجات   
                                                            </a>  
                                                            
                                                            <a href="{{route('vendor.color.show',$product->id)}}"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                               عرض لون المنتجات   
                                                            </a>  
                                                            <a href="{{route('vendor.size.show',$product->id)}}"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                               عرض حجم المنتجات   
                                                            </a>  

                                                          {{--<a href=""
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                 @if($product->active == 0)
                                                                     تفعيل
                                                                     @else
                                                                     الغاء تفعيل
                                                                 @endif
                                                             </a>
                                                          --}}
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