<aside class="main-sidebar sidebar-dark-warning elevation-4">
   <a href="#" class="brand-link">
      <img src="{{ asset('images-temp/AdminLogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CRM</span>
   </a>
   <div class="sidebar">
         {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">{!!image($user->image_id,160,160,$user->name)!!}</div>
            <div class="info">
               <a href="#" class="d-block">{{$user->name}}</a>
            </div>
         </div> --}}
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview{{ Request::is('admin','admin/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin','admin/dashboard','admin/log','admin/log/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>{{ __('Dashboard') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('dashboard') }}" class="nav-link{{ Request::is('admin','admin/dashboard')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Dashboard')}}</p>
                     </a>
                  </li>            
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/equipment','admin/equipment/*','admin/eqrepair', 'admin/eqrepair/*','admin/periodic', 'admin/periodic/*','admin/eqaccre', 'admin/eqaccre/*','admin/transfer', 'admin/transfer/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Quản lý thiết bị') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('equipment.index') }}" class="nav-link{{ Request::is('admin/equipment', 'admin/equipment/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Chi tiết thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Nhập thiết bị đơn lẻ') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Nhập thiết bị theo phiếu') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Danh sách thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('eqrepair.index') }}" class="nav-link{{ Request::is('admin/eqrepair', 'admin/eqrepair/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Sửa chữa thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('periodic.index') }}" class="nav-link{{ Request::is('admin/periodic', 'admin/periodic/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảo dưỡng định kỳ') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('eqaccre.index') }}" class="nav-link{{ Request::is('admin/eqaccre', 'admin/eqaccre/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Kiểm định') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('transfer.index') }}" class="nav-link{{ Request::is('admin/transfer', 'admin/transfer/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Điều chuyển thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Thanh lý thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Hồ sơ thiết bị') }}</p>
                     </a>
                  </li>                  
               </ul>
            </li>
            <li class="nav-item has-treeview">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Báo hỏng và bảo dưỡng') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Phiếu báo hỏng') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">   
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Phiếu yêu cầu bảo dưỡng') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/eqsupplie','admin/eqsupplie/*','admin/provider', 'admin/provider/*','admin/maintenance', 'admin/maintenance/*','admin/repair', 'admin/repair/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-bell"></i></i>
                  <p>{{ __('Quản lý vật tư') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('eqsupplie.index') }}" class="nav-link{{ Request::is('admin/eqsupplie', 'admin/eqsupplie/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Chi tiết vật tư') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Danh sách vật tư') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Nhập thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Import') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/cates','admin/cates/*','admin/device', 'admin/device/*','admin/supplie', 'admin/supplie/*','admin/unit', 'admin/unit/*','admin/project', 'admin/project/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Danh mục thiết bị/vật tư') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('equipment_cate.index') }}" class="nav-link{{ Request::is('admin/cates', 'admin/cates/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Nhóm thiết bị ') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('type_device.index') }}" class="nav-link{{ Request::is('admin/device', 'admin/device/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Loại thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('supplie.index') }}" class="nav-link{{ Request::is('admin/supplie', 'admin/supplie/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Loại vật tư') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('unit.index') }}" class="nav-link{{ Request::is('admin/unit', 'admin/unit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Đơn vị tính') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('project.index') }}" class="nav-link{{ Request::is('admin/project', 'admin/project/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Dự án') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Bảng kê – tổng hợp') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê nhập thiết bị, vật tư') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê thanh lí thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê yêu cầu sửa chữa') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê yêu cầu bảo dưỡng') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê điều chuyển') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bảng kê kiểm kho vật tư') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tổng hợp nhập thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('liquidation.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tổng hợp thanh lý') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tổng hợp yêu cầu bảo dưỡng') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tổng hợp yêu cầu sửa chữa') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Thống kê thiết bị') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Theo khoa') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Theo trạng thái, theo nhóm, loại') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Theo năm sử dụng') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Theo thông tin của thiết bị') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Thống kê vật tư') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/department','admin/department/*','admin/provider', 'admin/provider/*','admin/maintenance', 'admin/maintenance/*','admin/repair', 'admin/repair/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Quản lý tổ chức') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('department.index')}}" class="nav-link{{ Request::is('admin/department', 'admin/department/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Khoa – Phòng ban') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('provider.index')}}" class="nav-link{{ Request::is('admin/provider', 'admin/provider/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Nhà cung cấp') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('maintenance.index')}}" class="nav-link{{ Request::is('admin/maintenance', 'admin/maintenance/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Đơn vị bảo trì ') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('repair.index')}}" class="nav-link{{ Request::is('admin/repair', 'admin/repair/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Đơn vị sửa chữa ') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>{{ __('Thư viện') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('mediaAdmin') }}" class="nav-link{{ Request::is('admin/media','admin/media/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tất cả') }}</p>
                     </a>
                  </li>
                  {{-- <li class="nav-item">
                     <a href="{{ route('mediaCatAdmin') }}" class="nav-link{{ Request::is('admin/media-cate','admin/media-cate/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Danh mục') }}</p>
                     </a>
                  </li> --}}
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/user','admin/user/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>{{ __('Thành viên') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.users') }}" class="nav-link{{ Request::is('admin/user', 'admin/user/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Tất cả') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.user_create') }}" class="nav-link{{ Request::is('admin/user/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Thêm mới') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/system','admin/system/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/system')? ' active': '' }}">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>{{ __('Cài đặt') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.system') }}" class="nav-link{{ Request::is('admin/system/option')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('System') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.roles') }}" class="nav-link{{ Request::is('admin/system/roles', 'admin/system/roles/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Roles and Permissions') }}</p>
                     </a>
                  </li>            
               </ul>
            </li>
            <li class="nav-item">
               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                     <i class="fas fa-sign-out-alt nav-icon"></i>{{ __('Đăng xuất') }}
                  </a>
               </form>
            </li>
         </ul>
      </nav>
   </div>
</aside>