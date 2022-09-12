<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.color') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>
                {{$row->color_name}} 
                <span class="foo" style="background-color: <?php echo $row->color_name; ?>">
                </span>
            </td>
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
                <a href="{{URL::to('admin/color/show/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.color.delete')}}','{{ trans('labels.delete_color') }}','{{ trans('labels.delete') }}')">
                    <i class="ft-trash font-medium-3"></i>
                </a>
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>