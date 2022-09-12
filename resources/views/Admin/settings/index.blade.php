@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.settings') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">Settings</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif

                    @if(Session::has('danger'))
                    <div class="alert alert-danger">
                        {{ Session::get('danger') }}
                        @php
                            Session::forget('danger');
                        @endphp
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="px-3">
                                <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                                    <input type="hidden" name="old_img" class="form-control" value="{{$data->logo}}">
                                    <input type="hidden" name="old_favicon" class="form-control" value="{{$data->favicon}}">
                                    <input type="hidden" name="old_og_image" class="form-control" value="{{$data->og_image}}">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-user"></i> Basic Info</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="firebase_key">{{ trans('labels.firebase_key') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="firebase_key" class="form-control" placeholder="{{ trans('labels.firebase_key') }}" value="{{$data->firebase_key}}">
                                                @if ($errors->has('firebase_key'))
                                                    <span class="text-danger">{{ $errors->first('firebase_key') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="currency">{{ trans('labels.currency') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="currency" class="form-control" placeholder="{{ trans('labels.currency') }}" value="{{$data->currency}}">
                                                @if ($errors->has('currency'))
                                                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="currency_position">{{ trans('labels.currency_position') }}</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="currency_position">\
                                                    <option value="">{{ trans('labels.select_currency_position') }}</option>
                                                    <option value="right" {{ $data->currency_position == "right" ? 'selected' : '' }}>{{ trans('labels.right') }}</option>
                                                    <option value="left" {{ $data->currency_position == "left" ? 'selected' : '' }}>{{ trans('labels.left') }}</option>
                                                </select>
                                                @if ($errors->has('currency_position'))
                                                    <span class="text-danger">{{ $errors->first('currency_position') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="logo">{{ trans('labels.logo') }}</label>
                                            <div class="col-md-9">
                                                <input type="file" name="logo" class="form-control" placeholder="{{ trans('labels.logo') }}">
                                                <img src='{!! asset("storage/app/public/images/settings/".$data->logo) !!}' class='media-object round-media height-50 mt-3'>
                                                @if ($errors->has('logo'))
                                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="favicon">{{ trans('labels.favicon') }}</label>
                                            <div class="col-md-9">
                                                <input type="file" name="favicon" class="form-control" placeholder="{{ trans('labels.favicon') }}">
                                                <img src='{!! asset("storage/app/public/images/settings/".$data->favicon) !!}' class='media-object round-media height-50 mt-3'>
                                                @if ($errors->has('favicon'))
                                                    <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="min_balance">Minimum balance for withdrawal</label>
                                            <div class="col-md-9">
                                                <input type="text" name="min_balance" class="form-control" placeholder="{{ trans('labels.min_balance') }}" value="{{$data->min_balance}}">
                                                @if ($errors->has('min_balance'))
                                                    <span class="text-danger">{{ $errors->first('min_balance') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="timezone">{{ trans('labels.timezone') }}</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="timezone" id="timezone">
                                                  <option value="">{{ trans('messages.select_timezone') }}</option>
                                                  <option value="Pacific/Midway" {{$data->timezone == "Pacific/Midway"  ? 'selected' : ''}}>(GMT-11:00) Midway Island, Samoa</option>
                                                  <option value="America/Adak" {{$data->timezone == "America/Adak"  ? 'selected' : ''}}>(GMT-10:00) Hawaii-Aleutian</option>
                                                  <option value="Etc/GMT+10" {{$data->timezone == "Etc/GMT+10"  ? 'selected' : ''}}>(GMT-10:00) Hawaii</option>
                                                  <option value="Pacific/Marquesas" {{$data->timezone == "Pacific/Marquesas"  ? 'selected' : ''}}>(GMT-09:30) Marquesas Islands</option>
                                                  <option value="Pacific/Gambier" {{$data->timezone == "Pacific/Gambier"  ? 'selected' : ''}}>(GMT-09:00) Gambier Islands</option>
                                                  <option value="America/Anchorage" {{$data->timezone == "America/Anchorage"  ? 'selected' : ''}}>(GMT-09:00) Alaska</option>
                                                  <option value="America/Ensenada" {{$data->timezone == "America/Ensenada"  ? 'selected' : ''}}>(GMT-08:00) Tijuana, Baja California</option>
                                                  <option value="Etc/GMT+8" {{$data->timezone == "Etc/GMT+8"  ? 'selected' : ''}}>(GMT-08:00) Pitcairn Islands</option>
                                                  <option value="America/Los_Angeles" {{$data->timezone == "America/Los_Angeles"  ? 'selected' : ''}}>(GMT-08:00) Pacific Time (US & Canada)</option>
                                                  <option value="America/Denver" {{$data->timezone == "America/Denver"  ? 'selected' : ''}}>(GMT-07:00) Mountain Time (US & Canada)</option>
                                                  <option value="America/Chihuahua" {{$data->timezone == "America/Chihuahua"  ? 'selected' : ''}}>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                  <option value="America/Dawson_Creek" {{$data->timezone == "America/Dawson_Creek"  ? 'selected' : ''}}>(GMT-07:00) Arizona</option>
                                                  <option value="America/Belize" {{$data->timezone == "America/Belize"  ? 'selected' : ''}}>(GMT-06:00) Saskatchewan, Central America</option>
                                                  <option value="America/Cancun" {{$data->timezone == "America/Cancun"  ? 'selected' : ''}}>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                  <option value="Chile/EasterIsland" {{$data->timezone == "Chile/EasterIsland"  ? 'selected' : ''}}>(GMT-06:00) Easter Island</option>
                                                  <option value="America/Chicago" {{$data->timezone == "America/Chicago"  ? 'selected' : ''}}>(GMT-06:00) Central Time (US & Canada)</option>
                                                  <option value="America/New_York" {{$data->timezone == "America/New_York"  ? 'selected' : ''}}>(GMT-05:00) Eastern Time (US & Canada)</option>
                                                  <option value="America/Havana" {{$data->timezone == "America/Havana"  ? 'selected' : ''}}>(GMT-05:00) Cuba</option>
                                                  <option value="America/Bogota" {{$data->timezone == "America/Bogota"  ? 'selected' : ''}}>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                  <option value="America/Caracas" {{$data->timezone == "America/Caracas"  ? 'selected' : ''}}>(GMT-04:30) Caracas</option>
                                                  <option value="America/Santiago" {{$data->timezone == "America/Santiago"  ? 'selected' : ''}}>(GMT-04:00) Santiago</option>
                                                  <option value="America/La_Paz" {{$data->timezone == "America/La_Paz"  ? 'selected' : ''}}>(GMT-04:00) La Paz</option>
                                                  <option value="Atlantic/Stanley" {{$data->timezone == "Atlantic/Stanley"  ? 'selected' : ''}}>(GMT-04:00) Faukland Islands</option>
                                                  <option value="America/Campo_Grande" {{$data->timezone == "America/Campo_Grande"  ? 'selected' : ''}}>(GMT-04:00) Brazil</option>
                                                  <option value="America/Goose_Bay" {{$data->timezone == "America/Goose_Bay"  ? 'selected' : ''}}>(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                                  <option value="America/Glace_Bay" {{$data->timezone == "America/Glace_Bay"  ? 'selected' : ''}}>(GMT-04:00) Atlantic Time (Canada)</option>
                                                  <option value="America/St_Johns" {{$data->timezone == "America/St_Johns" ? 'selected' : ''}}>(GMT-03:30) Newfoundland</option>
                                                  <option value="America/Araguaina" {{$data->timezone == "America/Araguaina"  ? 'selected' : ''}}>(GMT-03:00) UTC-3</option>
                                                  <option value="America/Montevideo" {{$data->timezone == "America/Montevideo"  ? 'selected' : ''}}>(GMT-03:00) Montevideo</option>
                                                  <option value="America/Miquelon" {{$data->timezone == "America/Miquelon"  ? 'selected' : ''}}>(GMT-03:00) Miquelon, St. Pierre</option>
                                                  <option value="America/Godthab" {{$data->timezone == "America/Godthab"  ? 'selected' : ''}}>(GMT-03:00) Greenland</option>
                                                  <option value="America/Argentina/Buenos_Aires" {{$data->timezone == "America/Argentina/Buenos_Aires"  ? 'selected' : ''}}>(GMT-03:00) Buenos Aires</option>
                                                  <option value="America/Sao_Paulo" {{$data->timezone == "America/Sao_Paulo"  ? 'selected' : ''}}>(GMT-03:00) Brasilia</option>
                                                  <option value="America/Noronha" {{$data->timezone == "America/Noronha"  ? 'selected' : ''}}>(GMT-02:00) Mid-Atlantic</option>
                                                  <option value="Atlantic/Cape_Verde" {{$data->timezone == "Atlantic/Cape_Verde"  ? 'selected' : ''}}>(GMT-01:00) Cape Verde Is.</option>
                                                  <option value="Atlantic/Azores" {{$data->timezone == "Atlantic/Azores"  ? 'selected' : ''}}>(GMT-01:00) Azores</option>
                                                  <option value="Europe/Belfast" {{$data->timezone == "Europe/Belfast"  ? 'selected' : ''}}>(GMT) Greenwich Mean Time : Belfast</option>
                                                  <option value="Europe/Dublin" {{$data->timezone == "Europe/Dublin"  ? 'selected' : ''}}>(GMT) Greenwich Mean Time : Dublin</option>
                                                  <option value="Europe/Lisbon" {{$data->timezone == "Europe/Lisbon"  ? 'selected' : ''}}>(GMT) Greenwich Mean Time : Lisbon</option>
                                                  <option value="Europe/London" {{$data->timezone == "Europe/London"  ? 'selected' : ''}}>(GMT) Greenwich Mean Time : London</option>
                                                  <option value="Africa/Abidjan" {{$data->timezone == "Africa/Abidjan"  ? 'selected' : ''}}>(GMT) Monrovia, Reykjavik</option>
                                                  <option value="Europe/Amsterdam" {{$data->timezone == "Europe/Amsterdam"  ? 'selected' : ''}}>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                  <option value="Europe/Belgrade" {{$data->timezone == "Europe/Belgrade"  ? 'selected' : ''}}>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                  <option value="Europe/Brussels" {{$data->timezone == "Europe/Brussels"  ? 'selected' : ''}}>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                  <option value="Africa/Algiers" {{$data->timezone == "Africa/Algiers"  ? 'selected' : ''}}>(GMT+01:00) West Central Africa</option>
                                                  <option value="Africa/Windhoek" {{$data->timezone == "Africa/Windhoek"  ? 'selected' : ''}}>(GMT+01:00) Windhoek</option>
                                                  <option value="Asia/Beirut" {{$data->timezone == "Asia/Beirut"  ? 'selected' : ''}}>(GMT+02:00) Beirut</option>
                                                  <option value="Africa/Cairo" {{$data->timezone == "Africa/Cairo"  ? 'selected' : ''}}>(GMT+02:00) Cairo</option>
                                                  <option value="Asia/Gaza" {{$data->timezone == "Asia/Gaza"  ? 'selected' : ''}}>(GMT+02:00) Gaza</option>
                                                  <option value="Africa/Blantyre" {{$data->timezone == "Africa/Blantyre"  ? 'selected' : ''}}>(GMT+02:00) Harare, Pretoria</option>
                                                  <option value="Asia/Jerusalem" {{$data->timezone == "Asia/Jerusalem"  ? 'selected' : ''}}>(GMT+02:00) Jerusalem</option>
                                                  <option value="Europe/Minsk" {{$data->timezone == "Europe/Minsk" ? 'selected' : ''}}>(GMT+02:00) Minsk</option>
                                                  <option value="Asia/Damascus" {{$data->timezone == "Asia/Damascus" ? 'selected' : ''}}>(GMT+02:00) Syria</option>
                                                  <option value="Europe/Moscow" {{$data->timezone == "Europe/Moscow"  ? 'selected' : ''}}>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                  <option value="Africa/Addis_Ababa" {{$data->timezone == "Africa/Addis_Ababa"  ? 'selected' : ''}}>(GMT+03:00) Nairobi</option>
                                                  <option value="Asia/Tehran" {{$data->timezone == "Asia/Tehran"  ? 'selected' : ''}}>(GMT+03:30) Tehran</option>
                                                  <option value="Asia/Dubai" {{$data->timezone == "Asia/Dubai"  ? 'selected' : ''}}>(GMT+04:00) Abu Dhabi, Muscat</option>
                                                  <option value="Asia/Yerevan" {{$data->timezone == "Asia/Yerevan"  ? 'selected' : ''}}>(GMT+04:00) Yerevan</option>
                                                  <option value="Asia/Kabul" {{$data->timezone == "Asia/Kabul"  ? 'selected' : ''}}>(GMT+04:30) Kabul</option>
                                                  <option value="Asia/Yekaterinburg" {{$data->timezone == "Asia/Yekaterinburg"  ? 'selected' : ''}}>(GMT+05:00) Ekaterinburg</option>
                                                  <option value="Asia/Tashkent" {{$data->timezone == "Asia/Tashkent"  ? 'selected' : ''}}>(GMT+05:00) Tashkent</option>
                                                  <option value="Asia/Kolkata" {{$data->timezone == "Asia/Kolkata"  ? 'selected' : ''}}>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                  <option value="Asia/Katmandu" {{$data->timezone == "Asia/Katmandu"  ? 'selected' : ''}}>(GMT+05:45) Kathmandu</option>
                                                  <option value="Asia/Dhaka" {{$data->timezone == "Asia/Dhaka"  ? 'selected' : ''}}>(GMT+06:00) Astana, Dhaka</option>
                                                  <option value="Asia/Novosibirsk" {{$data->timezone == "Asia/Novosibirsk"  ? 'selected' : ''}}>(GMT+06:00) Novosibirsk</option>
                                                  <option value="Asia/Rangoon" {{$data->timezone == "Asia/Rangoon"  ? 'selected' : ''}}>(GMT+06:30) Yangon (Rangoon)</option>
                                                  <option value="Asia/Bangkok" {{$data->timezone == "Asia/Bangkok"  ? 'selected' : ''}}>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                  <option value="Asia/Krasnoyarsk" {{$data->timezone == "Asia/Krasnoyarsk"  ? 'selected' : ''}}>(GMT+07:00) Krasnoyarsk</option>
                                                  <option value="Asia/Hong_Kong" {{$data->timezone == "Asia/Hong_Kong"  ? 'selected' : ''}}>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                  <option value="Asia/Irkutsk" {{$data->timezone == "Asia/Irkutsk"  ? 'selected' : ''}}>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                  <option value="Australia/Perth" {{$data->timezone == "Australia/Perth"  ? 'selected' : ''}}>(GMT+08:00) Perth</option>
                                                  <option value="Australia/Eucla" {{$data->timezone == "Australia/Eucla"  ? 'selected' : ''}}>(GMT+08:45) Eucla</option>
                                                  <option value="Asia/Tokyo" {{$data->timezone == "Asia/Tokyo"  ? 'selected' : ''}}>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                  <option value="Asia/Seoul" {{$data->timezone == "Asia/Seoul"  ? 'selected' : ''}}>(GMT+09:00) Seoul</option>
                                                  <option value="Asia/Yakutsk" {{$data->timezone == "Asia/Yakutsk"  ? 'selected' : ''}}>(GMT+09:00) Yakutsk</option>
                                                  <option value="Australia/Adelaide" {{$data->timezone == "Australia/Adelaide"  ? 'selected' : ''}}>(GMT+09:30) Adelaide</option>
                                                  <option value="Australia/Darwin" {{$data->timezone == "Australia/Darwin"  ? 'selected' : ''}}>(GMT+09:30) Darwin</option>
                                                  <option value="Australia/Brisbane" {{$data->timezone == "Australia/Brisbane"  ? 'selected' : ''}}>(GMT+10:00) Brisbane</option>
                                                  <option value="Australia/Hobart" {{$data->timezone == "Australia/Hobart"  ? 'selected' : ''}}>(GMT+10:00) Hobart</option>
                                                  <option value="Asia/Vladivostok" {{$data->timezone == "Asia/Vladivostok"  ? 'selected' : ''}}>(GMT+10:00) Vladivostok</option>
                                                  <option value="Australia/Lord_Howe" {{$data->timezone == "Australia/Lord_Howe"  ? 'selected' : ''}}>(GMT+10:30) Lord Howe Island</option>
                                                  <option value="Etc/GMT-11" {{$data->timezone == "Etc/GMT-11"  ? 'selected' : ''}}>(GMT+11:00) Solomon Is., New Caledonia</option>
                                                  <option value="Asia/Magadan" {{$data->timezone == "Asia/Magadan"  ? 'selected' : ''}}>(GMT+11:00) Magadan</option>
                                                  <option value="Pacific/Norfolk" {{$data->timezone == "Pacific/Norfolk"  ? 'selected' : ''}}>(GMT+11:30) Norfolk Island</option>
                                                  <option value="Asia/Anadyr" {{$data->timezone == "Asia/Anadyr"  ? 'selected' : ''}}>(GMT+12:00) Anadyr, Kamchatka</option>
                                                  <option value="Pacific/Auckland" {{$data->timezone == "Pacific/Auckland"  ? 'selected' : ''}}>(GMT+12:00) Auckland, Wellington</option>
                                                  <option value="Etc/GMT-12" {{$data->timezone == "Etc/GMT-12"  ? 'selected' : ''}}>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                  <option value="Pacific/Chatham" {{$data->timezone == "Pacific/Chatham"  ? 'selected' : ''}}>(GMT+12:45) Chatham Islands</option>
                                                  <option value="Pacific/Tongatapu" {{$data->timezone == "Pacific/Tongatapu"  ? 'selected' : ''}}>(GMT+13:00) Nuku'alofa</option>
                                                  <option value="Pacific/Kiritimati" {{$data->timezone == "Pacific/Kiritimati"  ? 'selected' : ''}}>(GMT+14:00) Kiritimati</option>
                                                </select>
                                                @if ($errors->has('timezone'))
                                                    <span class="text-danger">{{ $errors->first('timezone') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="admin_commission">Admin commission (%)</label>
                                            <div class="col-md-9">
                                                <input type="text" name="admin_commission" class="form-control" placeholder="{{ trans('labels.admin_commission') }}" value="{{$data->admin_commission}}">
                                                @if ($errors->has('admin_commission'))
                                                    <span class="text-danger">{{ $errors->first('admin_commission') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="copyright">Copyright</label>
                                            <div class="col-md-9">
                                                <input type="text" name="copyright" class="form-control" placeholder="{{ trans('labels.copyright') }}" value="{{$data->copyright}}">
                                                @if ($errors->has('copyright'))
                                                    <span class="text-danger">{{ $errors->first('copyright') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="address">Address</label>
                                            <div class="col-md-9">
                                                <input type="text" name="address" class="form-control" placeholder="{{ trans('labels.address') }}" value="{{$data->address}}">
                                                @if ($errors->has('address'))
                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="contact">Contact</label>
                                            <div class="col-md-9">
                                                <input type="text" name="contact" class="form-control" placeholder="{{ trans('labels.contact') }}" value="{{$data->contact}}">
                                                @if ($errors->has('contact'))
                                                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="email">E-mail</label>
                                            <div class="col-md-9">
                                                <input type="text" name="email" class="form-control" placeholder="{{ trans('labels.email') }}" value="{{$data->email}}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <h4 class="form-section"><i class="fa fa-bar-chart"></i> SEO </h4>
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="site_title">Website Title</label>
                                            <div class="col-md-9">
                                                <input type="text" name="site_title" class="form-control" placeholder="{{ trans('labels.site_title') }}" value="{{$data->site_title}}">
                                                @if ($errors->has('site_title'))
                                                    <span class="text-danger">{{ $errors->first('site_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="meta_title">Meta Title</label>
                                            <div class="col-md-9">
                                                <input type="text" name="meta_title" class="form-control" placeholder="{{ trans('labels.meta_title') }}" value="{{$data->meta_title}}">
                                                @if ($errors->has('meta_title'))
                                                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="meta_description">Meta Description</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="meta_description">{{$data->meta_description}}</textarea>
                                                @if ($errors->has('meta_description'))
                                                    <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="og_image">{{ trans('labels.og_image') }}</label>
                                            <div class="col-md-9">
                                                <input type="file" name="og_image" class="form-control" placeholder="{{ trans('labels.og_image') }}">
                                                <img src='{!! asset("storage/app/public/images/settings/".$data->og_image) !!}' class='media-object round-media height-50 mt-3'>
                                                @if ($errors->has('og_image'))
                                                    <span class="text-danger">{{ $errors->first('og_image') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <h4 class="form-section"><i class="fa fa-bar-chart"></i> Social Accounts </h4>
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="facebook">Facebook</label>
                                            <div class="col-md-9">
                                                <input type="text" name="facebook" class="form-control" placeholder="{{ trans('labels.facebook') }}" value="{{$data->facebook}}">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="twitter">Twitter</label>
                                            <div class="col-md-9">
                                                <input type="text" name="twitter" class="form-control" placeholder="{{ trans('labels.twitter') }}" value="{{$data->twitter}}">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="instagram">Instagram</label>
                                            <div class="col-md-9">
                                                <input type="text" name="instagram" class="form-control" placeholder="{{ trans('labels.instagram') }}" value="{{$data->instagram}}">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="linkedin">Linkedin</label>
                                            <div class="col-md-9">
                                                <input type="text" name="linkedin" class="form-control" placeholder="{{ trans('labels.linkedin') }}" value="{{$data->linkedin}}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions text-right">
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </form>
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