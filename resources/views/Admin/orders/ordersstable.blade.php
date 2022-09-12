<table class="table table-striped table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            @if(Auth::user()->roles->first()->name == "super-admin")
            <th class="text-center">{{ trans('labels.vendor_name') }}</th>
            @endif
            <th class="text-center">{{ trans('labels.order_number') }}</th>
            <th class="text-center">{{ trans('labels.no_of_products') }}</th>
            <th class="text-center">{{ trans('labels.customer') }}</th>
            <th class="text-center">{{ trans('labels.order_total') }}</th>
            <th class="text-center">{{ trans('labels.date') }}</th>
            <th class="text-center">{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @forelse($data as $row)
        <tr id="del-{{$row->id}}">
            <td class="text-center">{{++$n}}</td>
            @if(Auth::user()->roles->first()->name == "super-admin")
            <td class="text-center">{{$row['vendors']->name}}</td>
            @endif
            <td class="text-center">{{$row->order_number}}</td>
            <td class="text-center">{{$row->no_products}}</td>
            <td class="text-center">{{$row->full_name}}</td>
            <td class="text-center">{{Helper::CurrencyFormatter($row->grand_total)}}</td>
            <td class="text-center">{{$row->date}}</td>
            <td class="text-center">
                <a href="{{URL::to('admin/orders/order-details/'.$row->order_number)}}" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                    <span class="badge badge-warning">View</span>
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