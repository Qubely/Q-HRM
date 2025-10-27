@extends('employee.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
    <style>
        .watch {
            font-size: 3em;
            color: #00ffff;
            padding: 20px 40px;
            border: 2px solid #00ffff;
            border-radius: 10px;
            text-align: center;
            background-color: #000;
        }

        .ampm {
            font-size: 0.4em;
            vertical-align: super;
            color: #ff00ff;
            margin-left: 8px;
        }
        .time-card {
            background: #0d6efd;
            color: #fff;
            border-radius: 15px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .time-card h1 {
            font-size: 4rem;
            margin: 0;
            font-weight: bold;
        }
        .time-card p {
            font-size: 1.2rem;
            margin-top: 10px;
            opacity: 0.8;
        }
        .fa-clock {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #ffc107;
        }
        .time-title {
            color: white;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            {{-- @can('employee_attendance_entry_store_view') --}}
                <div class="">
                    @include('employee.pages.attendance.entry.form.store.fragments._breadcum')
                    <div class="card rounded page-block">
                        <div class="p-3">
                            <div class="p-3">
                                {{-- @can('employee_attendance_entry_store_store') --}}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div>
                                                <h3 class="fw-bold fs-20 mb-4">  {{pxLang($data['lang'],'module.title')}} {{\Carbon\Carbon::now()->format('d M Y')}} </h3>
                                                <div class="watch" id="watch">--:--:--</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @include('employee.pages.attendance.entry.form.store.fragments._in-time')
                                                </div>
                                                <div class="col-md-4">
                                                    @include('employee.pages.attendance.entry.form.store.fragments._out-time')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @else
                                    @include('common.view.fragments.-item-403')
                                @endcan --}}
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @else
                @include('common.view.fragments.-item-403')
            @endcan --}}
        </div>
    </div>
    <script>
    function updateWatch() {
      const now = new Date();
      let hours = now.getHours();
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12;
      hours = String(hours).padStart(2, '0');

      document.getElementById('watch').innerHTML = `${hours}:${minutes}:${seconds} <span class="ampm">${ampm}</span>`;
    }
    setInterval(updateWatch, 1000);
    updateWatch(); // Initial call
  </script>
@endsection



