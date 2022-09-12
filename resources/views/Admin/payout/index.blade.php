@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.payout_request') }}
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
                            <h4 class="card-title">{{ trans('labels.payout_request') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('labels.vendor_name') }}</th>
                                            <th>{{ trans('labels.amount') }}</th>
                                            <th>{{ trans('labels.status') }}</th>
                                            <th>{{ trans('labels.type') }}</th>
                                            <th>{{ trans('labels.created_at') }}</th>
                                            @if(Auth::user()->roles->first()->name == "super-admin")
                                                <th>{{ trans('labels.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @forelse($data as $row)
                                        <tr>
                                            <td>{{$row->request_id}}</td>
                                            <td>{{$row['vendors']->name}}</td>
                                            <td>
                                                {{ trans('labels.Requested_amount') }} : <b>{{Helper::CurrencyFormatter($row->amount)}}</b> <br>
                                                {{ trans('labels.Admin_commission') }} ({{$row->commission_pr}}%) : - <b>{{Helper::CurrencyFormatter($row->commission)}}</b> <br><br>
                                                {{ trans('labels.Payable_amount') }} : <b>{{Helper::CurrencyFormatter($row->paid_amount)}}</b>
                                            </td>
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-warning">{{ trans('labels.pending') }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ trans('labels.paid') }}</span>
                                                @endif
                                            </td>
                                            <td>{{$row->payment_method}}</td>
                                            <td>{{$row->created_at}}</td>
                                            @if(Auth::user()->roles->first()->name == "super-admin")
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-info pay-now" data-request-id="{{$row->request_id}}" data-vendor-name="{{$row['vendors']->name}}" data-vendor-id="{{$row['vendors']->id}}" data-amount="{{$row->paid_amount}}" data-bank-name="{{$row['bank']->bank_name}}" data-account-type="{{$row['bank']->account_type}}" data-account-number="{{$row['bank']->account_number}}" data-routing-number="{{$row['bank']->routing_number}}">{{ trans('labels.pay_now') }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            @endif
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

<!-- Modal PayNow-->
<div class="modal fade text-left" id="PayNow" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct">{{ trans('labels.pay') }}</label>
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
                  <td>{{ trans('labels.Bank_name') }}</td>
                  <td id="bank_name"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Account_type') }}</td>
                  <td id="account_type"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Account_number') }}</td>
                  <td id="account_number"></td>
              </tr>
              <tr>
                  <td>{{ trans('labels.Routing_number') }}</td>
                  <td id="routing_number"></td>
              </tr>
              </tbody>
          </table>

          <label># </label>
          <div class="form-group">
            <input type="text" class="form-control" name="request_id" id="request_id" readonly="">
          </div>

          <label>{{ trans('labels.vendor_name') }} </label>
          <div class="form-group">
            <input type="text" class="form-control" name="vendor_name" id="vendor_name" readonly="">
            <input type="hidden" class="form-control" name="vendor_id" id="vendor_id" readonly="">
          </div>

          <label>{{ trans('labels.Payable_amount') }} </label>
          <div class="form-group">
            <input type="text" class="form-control" name="pay_amount" id="pay_amount" readonly="">
          </div>

          <label>{{ trans('labels.payment_methods') }} </label>
          <div class="form-group">
            <select class="form-control" name="payment_method" required>
                <option value="">{{ trans('labels.select_method') }}</option>
                <option value="cash">{{ trans('labels.cash') }}</option>
                <option value="bank">{{ trans('labels.bank_payment') }}</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('labels.submit') }}">
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