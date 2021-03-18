<aside class="main-sidebar elevation-4" style="background-color:#edf6fe; overflow: scroll;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="./assets/login/images/logo.png" alt="Samithi Logo" class=""
    style="width:220px;height:80px">
</a>

<!-- Sidebar -->
<div class="sidebar" >
    <!-- Sidebar user panel (optional) -->
    
    <?php

    $user = App\Models\User::where('name',Session::get('name'))->first();
    $role = App\Models\UserRoles::where('user_id',$user->id)->first();
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="height:auto;">
        
        @if($role->hasPermission('2',$role->role_id))
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ (request()->segment(2) == 'home') ? 'active' : '' }}" style="color:#3e3e3e">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p> Dashboard</p>
              </a>
          </li>
          @endif
          @if($role->hasPermission('11',$role->role_id))
          <li class="nav-item">
            <a href="{{ route('list.MemberDetails') }}" class="nav-link {{ (request()->segment(2) == 'list.MemberDetails') ? 'active' : '' }}" style="color:#3e3e3e">
              <i class="nav-icon fa fa-search fa-lg"></i>
              <p> Search Members</p>
          </a>
      </li> 
      @endif
      @if($role->hasPermission('12',$role->role_id))
      <li class="nav-item">
        <a href="{{ route('list.notification') }}" class="nav-link {{ (request()->segment(2) == 'list.notification') ? 'active' : '' }}" style="color:#3e3e3e">
          <i class="nav-icon fa fa-bell fa-lg"></i>
          <p> Notifications</p>
      </a>
  </li> 
  @endif
  @if($role->hasPermission('6',$role->role_id)) 
  <li class="nav-item">
    <a href="{{ route('list.newsletter') }}" class="nav-link {{ (request()->segment(2) == 'list.newsletter') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-envelope  fa-lg"></i>
      <p> News Letter</p>
  </a>
</li>
@endif 
@if($role->hasPermission('13',$role->role_id))

<li class="nav-item">
    <a href="{{ route('list.polls') }}" class="nav-link {{ (request()->segment(2) == 'list.polls') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-hand-o-up fa-lg"></i>
      <p> Polls</p>
  </a>
</li> 
@endif
@if($role->hasPermission('15',$role->role_id))
<li class="nav-item">
    <a href="{{ route('listContributions') }}" class="nav-link {{ (request()->segment(2) == 'listContributions') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-gift fa-lg"></i>
      <p>Contributions</p>
  </a>
</li>
@endif
@if($role->hasPermission('19',$role->role_id))
<li class="nav-item">
    <a href="{{ route('listGeo') }}" class="nav-link {{ (request()->segment(2) == 'listGeo') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-map-marker fa-lg"></i>
      <p>Samithi Org Structure</p>
  </a>
</li>
@endif
@if($role->hasPermission('18',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.volunteer') }}" class="nav-link {{ (request()->segment(2) == 'list.volunteer') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p>Member Category Enrollment</p>
  </a>
</li> 

@endif
@if($role->hasPermission('21',$role->role_id))
<li class="nav-item">
    <a href="{{ route('Volunteer') }}" class="nav-link {{ (request()->segment(2) == 'Volunteer') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p>Karyakartha Geo</p>
  </a>
</li> 

@endif
@if($role->hasPermission('36',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.reports') }}" class="nav-link {{ (request()->segment(2) == 'list.reports') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p>Reports View & Download</p>
  </a>
</li> 

@endif
@if($role->hasPermission('37',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.reportsview') }}" class="nav-link {{ (request()->segment(2) == 'list.reports') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p>Reports</p>
  </a>
</li> 

@endif
@if($role->hasPermission('10',$role->role_id))
<li class="nav-item">
    <a href="{{ route('MemberEdit') }}" class="nav-link {{ (request()->segment(2) == 'MemberEdit') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p> Member (Active / Deactive)</p>
  </a>
</li> 
@endif
@if($role->hasPermission('38',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.memberGroup') }}" class="nav-link {{ (request()->segment(2) == 'memberGroup') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p> Member Group</p>
  </a>
</li> 
@endif
@if($role->hasPermission('39',$role->role_id))
<li class="nav-item">
    <a href="{{ route('add.groupMember') }}" class="nav-link {{ (request()->segment(2) == 'groupMember') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p> Add Group Members</p>
  </a>
</li> 
@endif
@if($role->hasPermission('14',$role->role_id))
<li class="nav-item">
    <a href="{{ route('listfeedback') }}" class="nav-link {{ (request()->segment(2) == 'listfeedback') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-comments-o fa-lg"></i>
      <p>Feedback</p>
  </a>
</li> 

@endif
@if($role->hasPermission('1',$role->role_id))
<li class="nav-item">
    <a href="{{ route('aboutus') }}" class="nav-link {{ (request()->segment(2) == 'aboutus') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-info-circle  fa-lg"></i>
      <p>About us</p>
  </a>
</li> 
@endif
@if($role->hasPermission('5',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.compliance') }}" class="nav-link {{ (request()->segment(2) == 'list.compliance') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-ellipsis-v  fa-lg"></i>
      <p> Compliance</p>
  </a>
</li>
@endif


@if($role->hasPermission('7',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.languageLock') }}" class="nav-link {{ (request()->segment(2) == 'list.languageLock') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-language fa-lg"></i>
      <p> Language Lock</p>
  </a>
</li> 
@endif
@if($role->hasPermission('8',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.AppList') }}" class="nav-link {{ (request()->segment(2) == 'list.AppList') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-file-image-o fa-lg"></i>
      <p> App Image</p>
  </a>
</li>
@endif
@if($role->hasPermission('9',$role->role_id))   
<li class="nav-item">
    <a href="{{ route('list.appIcon') }}" class="nav-link {{ (request()->segment(2) == 'list.appIcon') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-wrench fa-lg"></i>
      <p> App Icon</p>
  </a>
</li>
@endif
@if($role->hasPermission('17',$role->role_id))
<li class="nav-item">
    <a href="{{ route('list.ProfileDetails') }}" class="nav-link {{ (request()->segment(2) == 'list.ProfileDetails') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p> Profile Edit</p>
  </a>
</li> 
@endif            

@if($role->hasPermission('16',$role->role_id)) 
<li class="nav-item">
    <a href="{{ route('list.admin') }}" class="nav-link {{ (request()->segment(2) == 'list.admin') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-check fa-lg"></i>
      <p> Add admin</p>
  </a>
</li>
@endif

@if($role->hasPermission('40',$role->role_id)) 
<li class="nav-item">
    <a href="{{ route('MemberCategory.list') }}" class="nav-link {{ (request()->segment(2) == 'MemberCategory.list') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-list-alt fa-lg"></i>
      <p> Member Category-SA</p>
  </a>
</li>
@endif

@if($role->hasPermission('41',$role->role_id)) 
<li class="nav-item">
    <a href="{{ route('list.advertisements') }}" class="nav-link {{ (request()->segment(2) == 'list.advertisements') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-list-alt fa-lg"></i>
      <p> Advertisement</p>
  </a>
</li>
@endif
@if($role->hasPermission('42',$role->role_id)) 
<li class="nav-item">
    <a href="{{ route('MemberPending.list') }}" class="nav-link {{ (request()->segment(2) == 'MemberPending.list') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-list-alt fa-lg"></i>
      <p> Member Approval</p>
  </a>
</li>
@endif





<br><br><br>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
