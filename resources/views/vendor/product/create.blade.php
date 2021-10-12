@extends('layouts.vendor')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            
                            <li class="breadcrumb-item active">إضافة منتجات
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
                                <h4 class="card-title" id="basic-layout-form">ضافة المنتجات </h4>
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
                                <form class="form" action="{{route('vendor.product.store')}}" method="POST"enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$mamCategory_id}}" id="mamCategory_id" name="mamCategory_id">
                                        <input type="hidden" value="{{$vendor_id}}" id="vendor_id" name="vendor_id">
                                        <div class="row">
                                        
                                            <div class="col-md-6">
                                                
                                              <div class="form-group">
                                                  <label> صوره النتجات </label>
                                                    <label id="projectinput7" class="file center-block">
                                                      <input type="file" id="file" name="photo[]" multiple >
                                                      <span class="file-custom"></span>
                                                    </label>
                                                     @error('photo')
                                                      <span class="text-danger">{{$message}}</span> 
                                                      @enderror
                                                </div> 
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2"> أختر القسم الفرعي </label>
                                                    <select name="sub_categories_id" class="select2 form-control">
                                                        <optgroup label=" من فضلك أختر القسم الفرعي">
                                                            @if($sub_categories && $sub_categories-> count() > 0)
                                                                @foreach($sub_categories as $sub_category)
                                                                    <option
                                                                        value="{{$sub_category->id }}">{{$sub_category->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('sub_categories_id')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                    

                                        <div class="form-body">
                                        
                                            <h4 class="form-section"><i class="ft-home"></i>  بيانات المنتجات </h4>
                                            @if (getLanguges()->count()>0)
                                             @foreach (getLanguges() as $index=>$lang) 
                                        
                                                             
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  الاسم المنتجات {{__('messages.'.$lang -> abbr)}} </label>
                                                        <input type="text" value="" id="name"
                                                               class="form-control"
                                                               name="product[{{$index}}][name]">
                                                           @error("product.$index.name")
                                                           <span class="text-danger">{{$message}}</span> 
                                                           @enderror    
                                                        
                                                    </div>
                                                </div> 
                                                
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  وصف المنتجات {{__('messages.'.$lang -> abbr)}} </label>
                                                        <textarea  value="" id="name"
                                                               class="form-control"
                                                               name="product[{{$index}}][description]">
                                                        </textarea>   
                                                           @error("product.$index.description")
                                                           <span class="text-danger">{{$message}}</span> 
                                                           @enderror    
                                                      
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> سعر المنتجات {{__('messages.'.$lang -> abbr)}} </label>
                                                        <input type="text" value="" id="name"
                                                               class="form-control"
                                                               name="product[{{$index}}][price]">
                                                           @error("product.$index.price")
                                                           <span class="text-danger">{{$message}}</span> 
                                                           @enderror    
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> التخفيضات {{__('messages.'.$lang -> abbr)}} </label>
                                                        <input type="text" value="" id="name"
                                                               class="form-control"
                                                               name="product[{{$index}}][descount]">
                                                           @error("product.$index.descount")
                                                           <span class="text-danger">{{$message}}</span> 
                                                           @enderror    
                                                        
                                                    </div>
                                                </div>  
                                               

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الكمية {{__('messages.'.$lang -> abbr)}} </label>
                                                        <input type="text" value="" id="name"
                                                               class="form-control"
                                                               name="product[{{$index}}][quntity]">
                                                           @error("product.$index.quntity")
                                                           <span class="text-danger">{{$message}}</span> 
                                                           @enderror    
                                                        
                                                    </div>
                                                </div> 
                                                

                                                <div class="col-md-6 hidden">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اختصار اللغة-{{__('messages.'.$lang->abbr)}} </label>
                                                        <input type="text" value="{{$lang->abbr}}" id="abbr"
                                                               class="form-control"
                                                               name="product[{{$index}}][abbr]">
                                                               @error("product.$index.abbr")
                                                               <span class="text-danger">{{$message}}</span> 
                                                               @enderror  
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="product[{{$index}}][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة - {{__('messages.'.$lang->abbr)}} </label>


                                                               @error("product.$index.active")
                                                               <span class="text-danger">{{$message}}</span> 
                                                               @enderror    
                                                    </div>
                                                </div>
                                            </div>


                                                @endforeach
                                                
                                            @endif
                                            
                                            </div>


                                            
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
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