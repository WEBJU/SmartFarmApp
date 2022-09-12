<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.image') }}</th>
            <th>{{ trans('labels.name') }}</th>
            <th>{{ trans('labels.email') }}</th>
            <th>{{ trans('labels.mobile') }}</th>
            <th>{{ trans('labels.status') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td><img src='{!! asset("/storage/app/public/images/profile/".$row->profile_pic) !!}' class='media-object round-media height-50'></td>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->mobile}}</td>
            <td id="tdstatus{{$row->id}}"> 
                @if($row->is_available=='1') 
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="{{$row->id}}">
                      <span class="green-text">{{ trans('labels.active') }}</span>
                    </span>
                @else 
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="{{$row->id}}">
                        <span class="red-text">{{ trans('labels.deactive') }}</span>
                    </span>
                @endif

                <a href="{{URL::to('admin/vendors/vendor-details/'.$row->id)}}" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                    <span class="btn btn-raised btn-outline-warning round btn-min-width mr-1 mb-1">View</span>
                </a>
            </td>
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