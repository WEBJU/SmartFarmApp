@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | Subscribe list
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Subscribe list</h4>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{route('admin.subscribe.search')}}">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" placeholder="Type & Enter" value="{{ request()->get('search') }}" class="form-control round">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon4"><i class="ft-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @forelse($data as $row)
                                        <tr>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->created_at}}</td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    @if ($data->hasPages())
                                    <ul class="pagination justify-content-end" role="navigation">
                                        {{-- Previous Page Link --}}
                                        @if ($data->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                            </li>
                                        @endif

                                        <?php
                                            $start = $data->currentPage() - 2; // show 3 pagination links before current
                                            $end = $data->currentPage() + 2; // show 3 pagination links after current
                                            if($start < 1) {
                                                $start = 1; // reset start to 1
                                                $end += 1;
                                            } 
                                            if($end >= $data->lastPage() ) $end = $data->lastPage(); // reset end to last page
                                        ?>

                                        @if($start > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $data->url(1) }}">{{1}}</a>
                                            </li>
                                            @if($data->currentPage() != 4)
                                                {{-- "Three Dots" Separator --}}
                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                            @endif
                                        @endif
                                            @for ($i = $start; $i <= $end; $i++)
                                                <li class="page-item {{ ($data->currentPage() == $i) ? ' active' : '' }}">
                                                    <a class="page-link" href="{{ $data->url($i) }}">{{$i}}</a>
                                                </li>
                                            @endfor
                                        @if($end < $data->lastPage())
                                            @if($data->currentPage() + 3 != $data->lastPage())
                                                {{-- "Three Dots" Separator --}}
                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $data->url($data->lastPage()) }}">{{$data->lastPage()}}</a>
                                            </li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($data->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- Modal Add Review-->
<div class="modal fade text-left" id="PayNow" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct">Add Review</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="errorr" style="color: red;"></div>
      
      <form method="post" action="{{ route('admin.payout.update') }}" method="post">
      {{csrf_field()}}
        <div class="modal-body">

            <table class="table table-striped mar-no">
              <tbody>
              <tr>
                  <td>Bank name</td>
                  <td id="bank_name"></td>
              </tr>
              <tr>
                  <td>Account type</td>
                  <td id="account_type"></td>
              </tr>
              <tr>
                  <td>Account number</td>
                  <td id="account_number"></td>
              </tr>
              <tr>
                  <td>Routing number</td>
                  <td id="routing_number"></td>
              </tr>
              </tbody>
          </table>

          <label>Request ID </label>
          <div class="form-group">
            <input type="text" class="form-control" name="request_id" id="request_id" readonly="">
          </div>

          <label>Vendor Name </label>
          <div class="form-group">
            <input type="text" class="form-control" name="vendor_name" id="vendor_name" readonly="">
            <input type="hidden" class="form-control" name="vendor_id" id="vendor_id" readonly="">
          </div>

          <label>Payable amount </label>
          <div class="form-group">
            <input type="text" class="form-control" name="pay_amount" id="pay_amount" readonly="">
          </div>

          <label>Payment method </label>
          <div class="form-group">
            <select class="form-control" name="payment_method" required>
                <option value="">Select payment method</option>
                <option value="cash">cash</option>
                <option value="bank">Bank payment</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-raised btn-primary" value="Submit">
        </div>
      </form>
    </div>
  </div>
</div>
@section('scripttop')

<script type="text/javascript">
    $(document).ready(function(){
       $(".pay-now").click(function(){ // Click to only happen on announce links

         $("#request_id").val($(this).attr('data-request-id'));
         $("#vendor_name").val($(this).attr('data-vendor-name'));
         $("#vendor_id").val($(this).attr('data-vendor-id'));
         $("#pay_amount").val($(this).attr('data-amount'));
         $("#bank_name").text($(this).attr('data-bank-name'));
         $("#account_type").text($(this).attr('data-account-type'));
         $("#account_number").text($(this).attr('data-account-number'));
         $("#routing_number").text($(this).attr('data-routing-number'));
         $('#PayNow').modal('show');
       });
    });
</script>
@endsection