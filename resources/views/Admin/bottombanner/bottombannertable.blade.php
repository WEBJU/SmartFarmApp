<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.image') }}</th>
            <th>{{ trans('labels.type') }}</th>
            <th>{{ trans('labels.category') }}</th>
            <th>{{ trans('labels.product') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td><img src='{!! asset("storage/app/public/images/banner/".$row->image) !!}' class='media-object round-media height-50'></td>
            <td>{{$row->type}}</td>
            <td>
                @if ($row->type == "category")
                    {{@$row['category']->category_name}}
                @else
                    --
                @endif
            </td>
            <td>
                @if ($row->type == "product")
                    {{@$row['product']->product_name}}
                @else
                    --
                @endif
            </td>
            <td>
                <a href="{{URL::to('admin/bottombanner/show/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>