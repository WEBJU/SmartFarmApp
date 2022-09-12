@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.products') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section class="basic-elements">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_product') }}</div>
                </div>
            </div>
            @if(Session::has('danger'))
            <div class="alert alert-danger">
                {{ Session::get('danger') }}
                @php
                    Session::forget('danger');
                @endphp
            </div>
            @endif
            <form class="form" method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Product Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="cat_id" class="col-sm-2 col-form-label">{{ trans('labels.category') }}</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="cat_id" id="cat_id">
                                            <option value="">{{ trans('placeholder.select_category') }}</option>
                                            @foreach ($data as $category)
                                            <option value="{{$category->id}}" {{ old('cat_id') == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cat_id'))
                                            <span class="text-danger">{{ $errors->first('cat_id') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="subcat_id" class="col-sm-2 col-form-label">{{ trans('labels.subcategory') }}</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="subcat_id" id="subcat_id">
                                            <option value="">{{ trans('placeholder.select_subcategory') }}</option>
                                        </select>
                                        @if ($errors->has('subcat_id'))
                                            <span class="text-danger">{{ $errors->first('subcat_id') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="innersubcat_id" class="col-sm-2 col-form-label">{{ trans('labels.innersubcategory') }}</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="innersubcat_id" id="innersubcat_id">
                                            <option value="">{{ trans('placeholder.select_innersubcategory') }}</option>
                                        </select>
                                        @if ($errors->has('innersubcat_id'))
                                            <span class="text-danger">{{ $errors->first('innersubcat_id') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="product_name" class="col-sm-2 col-form-label">{{ trans('labels.product_name') }}</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="{{ trans('placeholder.product') }}" value="{{old('product_name')}}">
                                        @if ($errors->has('product_name'))
                                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="brand" class="col-sm-2 col-form-label">{{ trans('labels.brand') }}</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="brand" id="brand">
                                            <option value="">Select brand</option>
                                            @foreach ($brands as $brands)
                                            <option value="{{$brands->id}}">{{$brands->brand_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand'))
                                            <span class="text-danger">{{ $errors->first('brand') }}</span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="brand" class="col-sm-2 col-form-label">{{ trans('labels.sku') }}</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="{{ trans('placeholder.sku') }}" value="{{old('sku')}}">
                                        @if ($errors->has('sku'))
                                            <span class="text-danger">{{ $errors->first('sku') }}</span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="image" class="col-sm-2 col-form-label">{{ trans('labels.image') }}</label>
                                      <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image" name="image[]" multiple="true">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Tags</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                      <div class="edit-on-delete form-control" data-tags-input-name="tags"></div>
                                      <p class="text-muted">Type any word related to your product & enter space. This will create tag & use for search your product based on this.</p>
                                      @if ($errors->has('tags'))
                                          <span class="text-danger">{{ $errors->first('tags') }}</span>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Product price + Variation</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                  <div class="form-group row">
                                    <label for="is_variation" class="col-sm-2 col-form-label">{{ trans('labels.is_variation_available') }}</label>
                                    <div class="col-sm-10">
                                      <input class="is_variation" type="checkbox" {{ old('is_variation') == 'on' ? 'checked' : ''}} name="is_variation"/>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" @if (old('is_variation') == 'on') style="display: none;" @endif>
                                    <label for="product_price" class="col-sm-2 col-form-label">product price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="{{ trans('placeholder.price') }}" value="{{old('product_price')}}">
                                      @if ($errors->has('product_price'))
                                          <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" @if (old('is_variation') == 'on') style="display: none;" @endif>
                                    <label for="discounted_price" class="col-sm-2 col-form-label">{{ trans('labels.discounted_price') }}</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="{{ trans('placeholder.discounted_price') }}" value="{{old('discounted_price')}}">
                                      @if ($errors->has('discounted_price'))
                                          <span class="text-danger">{{ $errors->first('discounted_price') }}</span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" @if (old('is_variation') == 'on') style="display: none;" @endif>
                                    <label for="product_qty" class="col-sm-2 col-form-label">{{ trans('labels.qty') }}</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="{{ trans('placeholder.product_qty') }}" value="{{old('product_qty')}}">
                                      @if ($errors->has('product_qty'))
                                          <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group row variation" @if (old('is_variation') != 'on') style="display: none;" @endif>
                                    <label for="attribute" class="col-sm-2 col-form-label">{{ trans('labels.attribute') }}</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="attribute" id="attribute">
                                          <option value="">{{ trans('placeholder.select_attribute') }}</option>
                                          @foreach ($attribute as $attributes)
                                          <option value="{{$attributes->id}}">{{$attributes->attribute}}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('attribute'))
                                          <span class="text-danger">{{ $errors->first('attribute') }}</span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="row panel-body variation" @if (old('is_variation') != 'on') style="display: none;" @endif>

                                    @if (old('variation'))
                                      @foreach(old('variation') as $i => $quty)
                                      <div class="row removeclass{{$loop->index}}">
                                      
                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label">Variation</label>
                                            <input type="text" class="form-control" name="variation[{{$i}}]" id="variation" value="{{$quty}}" placeholder="Variation">
                                            @if ($errors->has('variation.'.$i))
                                                <span class="text-danger">Required *</span>
                                            @endif
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label">Price</label>
                                            <input type="text" class="form-control" id="price" name="price[{{$i}}]" pattern="[0-9]+" value="{{old('price')[$loop->index]}}" placeholder="Price">
                                            @if ($errors->has('price.'.$i))
                                                <span class="text-danger">Required *</span>
                                            @endif
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label">Discounted Price</label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[{{$i}}]" pattern="[0-9]+" placeholder="{{ trans('placeholder.discounted_variation_price') }}" value="{{old('discounted_variation_price')[$loop->index]}}">
                                            @if ($errors->has('discounted_variation_price.'.$i))
                                                <span class="text-danger">Required *</span>
                                            @endif
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label">{{ trans('labels.qty') }}</label>
                                          <input type="text" class="form-control" name="qty[{{$i}}]" pattern="[0-9]+" id="qty" value="{{old('qty')[$loop->index]}}">
                                          @if ($errors->has('qty.'.$i))
                                              <span class="text-danger">Required *</span>
                                          @endif
                                        </div>
                                      </div>

                                      @if ($loop->index == 0)
                                        <div class="col-sm-1 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-btn">
                                                <button class="btn btn-success" type="button" onclick="variation_fields();"> + </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      @else
                                        <div class="col-sm-1 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-btn">
                                                <button class="btn btn-danger" type="button" onclick="remove_variation_fields('{{$loop->index}}');"> - </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      @endif
                                      </div>
                                      @endforeach
                                    @else

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label">Variation</label>
                                            <input type="text" class="form-control" name="variation[]" id="variation" value="{{old('variation')}}" placeholder="Variation">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label">Price</label>
                                            <input type="text" class="form-control" id="price" name="price[]" pattern="[0-9]+" value="{{old('price')}}" placeholder="Price">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label">Discounted Price</label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[]" pattern="[0-9]+" placeholder="{{ trans('placeholder.discounted_price') }}">
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label">{{ trans('labels.qty') }}</label>
                                          <input type="text" class="form-control" name="qty[]" pattern="[0-9]+" id="qty">
                                        </div>
                                      </div>

                                      <div class="col-sm-1 nopadding">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-btn">
                                              <button class="btn btn-success" type="button"  onclick="variation_fields();"> + </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    @endif

                                    <div class="clear"></div>

                                  </div>

                                  <div id="variation_fields"></div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Product Description</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">{{ trans('labels.description') }}</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="description" name="description" rows="8" placeholder="{{ trans('placeholder.description') }}">{{old('description')}}</textarea>
                                      @if ($errors->has('description'))
                                          <span class="text-danger">{{ $errors->first('description') }}</span>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Shipping Configuration</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group pb-1">
                                        <label for="free_shipping" class="col-sm-4 col-form-label">Free Shipping</label>
                                      <div class="float-right">
                                        <label class="switch">
                                          <input type="checkbox" name="free_shipping" id="free_shipping">
                                          <span class="slider"></span>
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <div class="form-group pb-1">
                                        <label for="flat_rate" class="col-sm-4 col-form-label">Flat Rate</label>
                                      <div class="float-right">
                                        <label class="switch">
                                          <input type="checkbox" name="flat_rate" id="flat_rate">
                                          <span class="slider"></span>
                                        </label>
                                      </div>
                                    </div>
                                </div>

                                <div class="px-3 flat_rate_shipping_div" style="display: none">
                                    <div class="form-group row">
                                      <label for="shipping_cost" class="col-sm-4 col-form-label">Shipping cost</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" placeholder="{{ trans('placeholder.shipping_cost') }}" value="0">
                                        @if ($errors->has('shipping_cost'))
                                            <span class="text-danger">{{ $errors->first('shipping_cost') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Return policy</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group pb-1">
                                        <label for="is_return" class="col-sm-4 col-form-label">Is return available ?</label>
                                      <div class="float-right">
                                        <label class="switch">
                                          <input type="checkbox" name="is_return" id="is_return">
                                          <span class="slider"></span>
                                        </label>
                                      </div>
                                    </div>
                                </div>

                                <div class="px-3 is_return_div" style="display: none">
                                    <div class="form-group row">
                                      <label for="return_days" class="col-sm-4 col-form-label">Days</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="return_days" name="return_days" placeholder="{{ trans('placeholder.return_days') }}" value="0">
                                        @if ($errors->has('return_days'))
                                            <span class="text-danger">{{ $errors->first('return_days') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Low Stock Quantity Warning</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="available_stock" class="col-sm-4 col-form-label">Quantity</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="available_stock" name="available_stock" placeholder="{{ trans('placeholder.available_stock') }}" value="0">
                                        @if ($errors->has('available_stock'))
                                            <span class="text-danger">{{ $errors->first('available_stock') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Featured</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group pb-1">
                                        <label for="is_featured" class="col-sm-4 col-form-label">Status</label>
                                      <div class="float-right">
                                        <label class="switch">
                                          <input type="checkbox" name="is_featured" id="is_featured">
                                          <span class="slider"></span>
                                        </label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Hot Deals</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group pb-1">
                                        <label for="is_hot" class="col-sm-4 col-form-label">Status</label>
                                      <div class="float-right">
                                        <label class="switch">
                                          <input type="checkbox" name="is_hot" id="is_hot">
                                          <span class="slider"></span>
                                        </label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Estimate Shipping Time</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="est_shipping_days" class="col-sm-4 col-form-label">Shipping Days</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="est_shipping_days" name="est_shipping_days" placeholder="{{ trans('placeholder.est_shipping_days') }}" value="0">
                                        @if ($errors->has('est_shipping_days'))
                                            <span class="text-danger">{{ $errors->first('est_shipping_days') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Vat & TAX</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="tax" class="col-sm-4 col-form-label">Tax</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="{{ trans('placeholder.tax') }}" value="0">
                                        @if ($errors->has('tax'))
                                            <span class="text-danger">{{ $errors->first('tax') }}</span>
                                        @endif

                                        <select class="form-control mt-3" name="tax_type" id="tax_type">
                                            <option value="amount">Flat</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.products') }}" class="btn btn-raised btn-warning mr-1">
                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-raised btn-primary">
                            <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}
                        </button>
                    </div>
                </div>                
            </form>
        </section>
    </div>


@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript">
  var variationdata = 1;
  function variation_fields() {
   
      variationdata++;
      var objTo = document.getElementById('variation_fields')
      var divtest = document.createElement("div");
      divtest.setAttribute("class", "row variation removeclass"+variationdata);
      var rdiv = 'removeclass'+variationdata;
      divtest.innerHTML = '<div class="col-sm-3 nopadding"> <div class="form-group"> <label for="variation" class="col-form-label">Variation</label> <input type="text" class="form-control" name="variation[]" id="variation" placeholder="Variation" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="price" class="col-form-label">Price</label> <input type="text" class="form-control" id="price" name="price[]" pattern="[0-9]+" placeholder="Price" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="discounted_variation_price" class="col-form-label">Discounted Price</label> <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[]" pattern="[0-9]+" placeholder="{{ trans('placeholder.discounted_price') }}"> </div></div><div class="col-sm-2 nopadding"> <div class="form-group"> <label for="qty" class="col-form-label">{{trans('labels.qty')}}</label> <input type="text" class="form-control" name="qty[]" pattern="[0-9]+" id="qty"> </div></div><div class="col-sm-1 nopadding"> <div class="form-group"> <div class="input-group"> <div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_variation_fields('+ variationdata +');"> - </button> </div></div></div></div><div class="clear"></div>';
      
      objTo.appendChild(divtest)
  }
  function remove_variation_fields(rid) {
     $('.removeclass'+rid).remove();
  }

  $(document).ready(function($) {
      $("#cat_id").change(function () {
          var cat_id = $("#cat_id").val();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"{{ route('admin.products.subcat') }}",
              data:{      
              'cat_id':cat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value="">{{ trans('placeholder.select_subcategory') }}</option>';
                  for(i in response){              
                      html+='<option value="'+response[i].id+'">'+response[i].subcategory_name+'</option>'
                  }
                  $('#subcat_id').html(html);
              },              
          });
      });

      $("#subcat_id").change(function () {
          var subcat_id = $("#subcat_id").val();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"{{ route('admin.products.innersubcat') }}",
              data:{      
              'subcat_id':subcat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value="">{{ trans('placeholder.select_innersubcategory') }}</option>';
                  for(i in response){              
                      html+='<option value="'+response[i].id+'">'+response[i].innersubcategory_name+'</option>'
                  }
                  $('#innersubcat_id').html(html);
              },              
          });
      });
  });

  $(document).ready(function(){
      $('.is_variation').change(function(){
          if(this.checked) {
              $('.variation').fadeIn('slow');
              $('.default_price').fadeOut('slow');
          } else {
              $('.variation').fadeOut('slow');
              $('.default_price').fadeIn('slow');
          }
      });
  });

  $(document).ready(function() {
      var imagesPreview = function(input, placeToInsertImagePreview) {
          if (input.files) {
              var filesAmount = input.files.length;
              $('div.gallery').html('');
              var n=0;
              for (i = 0; i < filesAmount; i++) {
                  var reader = new FileReader();
                  reader.onload = function(event) {
                      $($.parseHTML('<div>')).attr('class', 'imgdiv').attr('id','img_'+n).html('<img src="'+event.target.result+'" class="img-fluid">').appendTo(placeToInsertImagePreview); 
                      n++;
                  }
                  reader.readAsDataURL(input.files[i]);                                  
              }
          }
      };

      $('#image').on('change', function() {
          imagesPreview(this, 'div.gallery');
      });
  });
  var images = [];
  function removeimg(id){
      images.push(id);
      $("#img_"+id).remove();
      $('#remove_'+id).remove();
      $('#removeimg').val(images.join(","));
      input.replaceWith(input.val('').clone(true));
  }

  $("#price").on("keypress keyup blur",function (event) {
      $(this).val($(this).val().replace(/[^0-9\.|\,]/g,''));
      debugger;
      if(event.which == 44)
      {
          return true;
      }
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57  )) {
          event.preventDefault();
      }
  });

  $(document).ready(function(){

      $("#free_shipping").on("change",function(){
          $('#flat_rate').prop('checked', false); // Unchecks it
          $(".flat_rate_shipping_div").hide();
      });

      $("#flat_rate").on('change', function() {
          if ($(this).is(':checked')) {
              $(".flat_rate_shipping_div").show();
              $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
             $(".flat_rate_shipping_div").hide();
          }
      });

      $("#is_return").on('change', function() {
          if ($(this).is(':checked')) {
              $(".is_return_div").show();
              $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
             $(".is_return_div").hide();
          }
      });
  });
</script>
@endsection