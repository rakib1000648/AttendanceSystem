 <!-- sidebar  -->
 <nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
     <div class="logo d-flex justify-content-between">
         <a href="{{ url('/') }}"><img src="{{ asset('admin') }}/img/master_fishing_logo.png"
                 style="height: 70px; width: 70px; margin-left:60px;" alt="master fishing"><br><span class="text-info"
                 style="margin-left:50px; margin-top:15px;">Master Fishing</span></a>
         <div class="sidebar_close_icon d-lg-none">
             <i class="ti-close"></i>
         </div>
     </div>
     <ul id="sidebar_menu">

         @if (auth()->user()->can('dashboard'))
             <li class="">
                 <a href="{{ url('dashboard') }}" aria-expanded="false">
                     <div class="icon_menu">
                         <img src="{{ asset('admin') }}/img/menu-icon/home-house-svgrepo-com.svg" alt="">
                     </div>
                     <span>Dashboard</span>
                 </a>
             </li>
         @endif



         <li class="mm-active">
             <a class="has-arrow" href="#" aria-expanded="false">
                 <div class="icon_menu">
                     <img src="{{ asset('admin') }}/img/menu-icon/checklist-svgrepo-com.svg" alt="">
                 </div>
                 <span>Daily Attendance</span>
             </a>
             <ul>
                 <li><a href="{{ url('daily-attendance-summary') }}">Total Summary</a></li>
                 <li><a href="{{ url('daily-present-summary') }}">Present Summary</a></li>
                 <li><a href="{{ url('daily-absent-summary') }}">Absent Summary</a></li>
                 <li><a href="{{ url('daily-late-summary') }}">Late Summary</a></li>
                 <li><a href="{{ url('daily-miss-punch') }}">Miss Punch</a></li>
             </ul>
         </li>

         <li class="mm-active">
             <a class="has-arrow" href="#" aria-expanded="false">
                 <div class="icon_menu">
                     <img src="{{ asset('admin') }}/img/menu-icon/checklist-svgrepo-com.svg" alt="">
                 </div>
                 <span>Monthly Attendance</span>
             </a>
             <ul>
                 {{-- <li><a href="{{ url('monthly-present-summary') }}">Present Summary</a></li>
                 <li><a href="{{ url('monthly-absent-summary') }}">Absent Summary</a></li>
                 <li><a href="{{ url('monthly-late-summary') }}">Late Summary</a></li>
                 <li><a href="{{ url('monthly-miss-punch') }}">MIss Punch</a></li>
                 <li><a href="{{ url('monthly-attendance-dept-dsgn') }}">Department/Designation</a></li>  --}}
                 <li><a href="{{ url('monthly-attendance-history') }}">Monthly History</a></li>
                 <li><a href="{{ url('monthly-attendance-punches') }}">Punch Records</a></li>
             </ul>
         </li>

         <li class="mm-active">
             <a class="has-arrow" href="#" aria-expanded="false">
                 <div class="icon_menu">
                     <img src="{{ asset('admin') }}/img/menu-icon/checklist-svgrepo-com.svg" alt="">
                 </div>
                 <span>Other Reports</span>
             </a>
             <ul>
                 <li><a href="{{ url('employee-shift-wise') }}">Shift Wise Employee</a></li>
                 <li><a href="{{ url('daily-early-leave') }}">Daily Early Leave</a></li>
                 <li><a href="{{ url('daily-leave') }}">Daily Leave</a></li>
                 <li><a href="{{ url('monthly-early-leave') }}">Monthly Early Leave</a></li>
                 <li><a href="{{ url('monthly-leave') }}">Monthly Leave</a></li>
             </ul>
         </li>

         @if (auth()->user()->can('company'))
             <li class="mm-active">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <div class="icon_menu">
                         <img src="{{ asset('admin') }}/img/menu-icon/building-svgrepo-com.svg" alt="">
                     </div>
                     <span>Company</span>
                 </a>
                 <ul>
                     <li><a href="{{ url('branches') }}">Branches</a></li>
                     <li><a href="{{ url('departments') }}">Departments</a></li>
                     <li><a href="{{ url('department-sections') }}">Department Section</a></li>
                     <li><a href="{{ url('shifts') }}">Working Shift</a></li>
                 </ul>
             </li>
         @endif


         @if (auth()->user()->can('role-list'))
             <li class="mm-active">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <div class="icon_menu">
                         <img src="{{ asset('admin') }}/img/menu-icon/desk-svgrepo-com.svg" alt="">
                     </div>
                     <span>Roles</span>
                 </a>
                 <ul>
                     <li><a href="{{ route('roles.index') }}">Manage Role</a></li>
                 </ul>
             </li>
         @endif



         @if (auth()->user()->can('employee-list'))
             <li class="mm-active">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <div class="icon_menu">
                         <img src="{{ asset('admin') }}/img/menu-icon/employees-svgrepo-com.svg" alt="">
                     </div>
                     <span>Employees</span>
                 </a>
                 <ul>
                     <li><a href="{{ url('employees') }}">Employees</a></li>
                     <li><a href="{{ url('designations') }}">Designations</a></li>
                     <li><a href="{{ url('employee-types') }}">Types</a></li>
                     <li><a href="{{ url('employee-positions') }}">Positions</a></li>
                     <li><a href="{{ url('holidays') }}">Holidays</a></li>
                     <li><a href="{{ url('leaves') }}">Add Leaves</a></li>
                     <li><a href="{{ url('leaves-yearly') }}">Leave Report</a></li>

                 </ul>
             </li>
         @endif

         {{-- @if (auth()->user()->can('attendance-report'))
             <li class="mm-active">
                 <a class="has-arrow" href="#" aria-expanded="false">
                     <div class="icon_menu">
                         <img src="{{ asset('admin') }}/img/menu-icon/checklist-svgrepo-com.svg" alt="">
                     </div>
                     <span>Attendance</span>
                 </a>
                 <ul>
                     <li><a href="{{ url('att-list') }}">Daily Report</a></li>
                     <li><a href="{{ url('att-list-monthly') }}">Monthly Report</a></li>
                 </ul>
             </li>
         @endif --}}



     </ul>
 </nav>
