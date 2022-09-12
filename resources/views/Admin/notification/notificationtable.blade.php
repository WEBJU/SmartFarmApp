<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.title') }}</th>
            <th>{{ trans('labels.message') }}</th>
            <th>{{ trans('labels.resend') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->message}}</td>
            <td>
                <a onclick="resend('{{$row->id}}','{{route('admin.notification.resend')}}','Resend Notification','Resend')" class="success p-0" title="View">
                    <i class="fa fa-repeat"></i>
                </a>
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>