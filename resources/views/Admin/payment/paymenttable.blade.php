<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.name') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{ $row->payment_name }}</td>
            <td id="tdstatus{{$row->id}}"> 
                @if($row->status=='1') 
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="{{$row->id}}">
                      <span class="green-text">{{ trans('labels.active') }}</span>
                    </span>
                @else 
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="{{$row->id}}">
                        <span class="red-text">{{ trans('labels.deactive') }}</span>
                    </span>
                @endif
            </td>
            <td>
                @if($row->payment_name != 'COD' && $row->payment_name != 'Wallet')
                    <a href="{{URL::to('admin/payments/manage-payment/'.$row->id)}}" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                        <span class="badge badge-warning">View</span>
                    </a>
                @endif
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>