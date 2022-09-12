@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.help') }}
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
                            <h4 class="card-title">{{ trans('labels.help') }}</h4>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{route('admin.help.search')}}">
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
                                            <th>{{ trans('labels.username') }}</th>
                                            <th>{{ trans('labels.contact_info') }}</th>
                                            <th>{{ trans('labels.subject') }}</th>
                                            <th>{{ trans('labels.message') }}</th>
                                            <th>{{ trans('labels.created_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @forelse($data as $row)
                                        <tr>
                                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                                            <td>{{$row->mobile}} <br><br> {{$row->email}} </td>
                                            <td>{{$row->subject}}</td>
                                            <td>{{$row->message}}</td>
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

@section('scripttop')

@endsection