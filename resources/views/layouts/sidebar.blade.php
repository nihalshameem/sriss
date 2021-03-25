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
        
         @if($role->havePermission('Dashboard',$role->role_id))
         <?php

    $permission = App\Models\Permission::where('slug','Dashboard')->first();
    ?>
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ (request()->segment(2) == 'home') ? 'active' : '' }}" style="color:#3e3e3e">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p> {{$permission->name}}</p>
              </a>
          </li>
          @endif
          @if($role->hasPermissions(['News Letter','Member (Activate / De activate)','Search Members','Notifications','Polls','Contributions','Feedback','Member Approval','Volunteer','Advertisement','Member Group','Add Group Members'],$role->role_id))
<li class="nav-item has-treeview">
            <a href="#" class="nav-link" style="color:#3e3e3e">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Operations
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style=" padding-left:20px">
               @if($role->havePermission('News Letter',$role->role_id)) 
               <?php

    $permission = App\Models\Permission::where('slug','News Letter')->first();
    ?>
                  <li class="nav-item">
                    <a href="{{ route('list.newsletter') }}" class="nav-link {{ (request()->segment(2) == 'list.newsletter') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-envelope  fa-lg"></i>
                      <p>  {{$permission->name}}</p>
                      </a>
                    </li>
                @endif 
              @if($role->havePermission('Member (Activate / De activate)',$role->role_id))
              <?php

    $permission = App\Models\Permission::where('slug','Member (Activate / De activate)')->first();
    ?>
                <li class="nav-item">
                <a href="{{ route('MemberEdit') }}" class="nav-link {{ (request()->segment(2) == 'MemberEdit') ? 'active' : '' }}" style="color:#3e3e3e">
                  <i class="nav-icon fa fa-user fa-lg"></i>
                  <p>  {{$permission->name}}</p>
                  </a>
                </li> 
              @endif
              @if($role->havePermission('Search Members',$role->role_id))
              <?php

    $permission = App\Models\Permission::where('slug','Search Members')->first();
    ?>
          <li class="nav-item">
            <a href="{{ route('list.MemberDetails') }}" class="nav-link {{ (request()->segment(2) == 'list.MemberDetails') ? 'active' : '' }}" style="color:#3e3e3e">
              <i class="nav-icon fa fa-search fa-lg"></i>
              <p>  {{$permission->name}}</p>
          </a>
      </li> 
      @endif
                    @if($role->havePermission('Notifications',$role->role_id))
                    <?php

    $permission = App\Models\Permission::where('slug','Notifications')->first();
    ?>
                    <li class="nav-item">
                      <a href="{{ route('list.notification') }}" class="nav-link {{ (request()->segment(2) == 'list.notification') ? 'active' : '' }}" style="color:#3e3e3e">
                        <i class="nav-icon fa fa-bell fa-lg"></i>
                        <p>  {{$permission->name}}</p>
                    </a>
                </li> 
                @endif
                      @if($role->havePermission('Polls',$role->role_id))
                      <?php

    $permission = App\Models\Permission::where('slug','Polls')->first();
    ?>

                      <li class="nav-item">
                          <a href="{{ route('list.polls') }}" class="nav-link {{ (request()->segment(2) == 'list.polls') ? 'active' : '' }}" style="color:#3e3e3e">
                            <i class="nav-icon fa fa-hand-o-up fa-lg"></i>
                            <p>  {{$permission->name}}</p>
                        </a>
                      </li> 
                      @endif
                      @if($role->havePermission('Contributions',$role->role_id))
                      <?php

    $permission = App\Models\Permission::where('slug','Contributions')->first();
    ?>
                      <li class="nav-item">
                          <a href="{{ route('listContributions') }}" class="nav-link {{ (request()->segment(2) == 'listContributions') ? 'active' : '' }}" style="color:#3e3e3e">
                            <i class="nav-icon fa fa-gift fa-lg"></i>
                            <p> {{$permission->name}}</p>
                        </a>
                      </li>
                      @endif
                      @if($role->havePermission('Feedback',$role->role_id))
                      <?php

                          $permission = App\Models\Permission::where('slug','Feedback')->first();
                      ?>
                        <li class="nav-item">
                            <a href="{{ route('listfeedback') }}" class="nav-link {{ (request()->segment(2) == 'listfeedback') ? 'active' : '' }}" style="color:#3e3e3e">
                              <i class="nav-icon fa fa-comments-o fa-lg"></i>
                              <p> {{$permission->name}}</p>
                          </a>
                        </li> 

                        @endif
                        @if($role->havePermission('Member Approval',$role->role_id))
                        <?php

                          $permission = App\Models\Permission::where('slug','Member Approval')->first();
                      ?> 
                        <li class="nav-item">
                            <a href="{{ route('MemberPending.list') }}" class="nav-link {{ (request()->segment(2) == 'list.admin') ? 'active' : '' }}" style="color:#3e3e3e">
                              <i class="nav-icon fa fa-check fa-lg"></i>
                              <p>  {{$permission->name}}</p>
                          </a>
                        </li>
                        @endif
                        @if($role->havePermission('Volunteer',$role->role_id))
                        <?php

                          $permission = App\Models\Permission::where('slug','Volunteer')->first();
                      ?> 
<li class="nav-item">
    <a href="{{ route('list.volunteer') }}" class="nav-link {{ (request()->segment(2) == 'list.volunteer') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p> {{$permission->name}}</p>
  </a>
</li> 

@endif
@if($role->havePermission('Advertisement',$role->role_id)) 
 <?php

                          $permission = App\Models\Permission::where('slug','Advertisement')->first();
                      ?> 
<li class="nav-item">
    <a href="{{ route('list.advertisements') }}" class="nav-link {{ (request()->segment(2) == 'list.advertisements') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-list-alt fa-lg"></i>
      <p> {{$permission->name}}</p>
  </a>
</li>
@endif
@if($role->havePermission('Member Group',$role->role_id))
<?php

                          $permission = App\Models\Permission::where('slug','Member Group')->first();
                      ?> 
<li class="nav-item">
    <a href="{{ route('list.memberGroup') }}" class="nav-link {{ (request()->segment(2) == 'memberGroup') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p>{{$permission->name}}</p>
  </a>
</li> 
@endif
@if($role->havePermission('Add Group Members',$role->role_id))
<?php

                          $permission = App\Models\Permission::where('slug','Add Group Members')->first();
                      ?> 
<li class="nav-item">
    <a href="{{ route('add.groupMember') }}" class="nav-link {{ (request()->segment(2) == 'groupMember') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-user fa-lg"></i>
      <p>{{$permission->name}}</p>
  </a>
</li> 
@endif
          
             
            </ul>
          </li>
@endif

@if($role->hasPermissions(['36','37'],$role->role_id))
<li class="nav-item has-treeview">
            <a href="#" class="nav-link" style="color:#3e3e3e">
              <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Reports
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style=" padding-left:20px">
               @if($role->havePermission('Reports View & Download',$role->role_id))
               <?php

                          $permission = App\Models\Permission::where('slug','Reports View & Download')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.reports') }}" class="nav-link {{ (request()->segment(2) == 'list.reports') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-users fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li> 

              @endif
              @if($role->havePermission('Reports',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','Reports')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.reportsview') }}" class="nav-link {{ (request()->segment(2) == 'list.reports') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-users fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li> 

              @endif
          
             
            </ul>
          </li>
@endif
     
@if($role->hasPermissions(['SSS Org Structure','Assign Volunteer To Geo'],$role->role_id))
<li class="nav-item has-treeview">
            <a href="#" class="nav-link" style="color:#3e3e3e">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Masters
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style=" padding-left:20px">
               @if($role->havePermission('SSS Org Structure',$role->role_id))
               <?php

                          $permission = App\Models\Permission::where('slug','SSS Org Structure')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('listGeo') }}" class="nav-link {{ (request()->segment(2) == 'listGeo') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-map-marker fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li>
              @endif
              @if($role->havePermission('Assign Volunteer To Geo',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','Assign Volunteer To Geo')->first();
                      ?> 
<li class="nav-item">
    <a href="{{ route('Volunteer') }}" class="nav-link {{ (request()->segment(2) == 'Volunteer') ? 'active' : '' }}" style="color:#3e3e3e">
      <i class="nav-icon fa fa-users fa-lg"></i>
      <p> {{$permission->name}}</p>
  </a>
</li> 

@endif

          
             
            </ul>
          </li>
@endif   

@if($role->hasPermissions(['App Image','About Us','Compliance','Language Permission','App Icon','Profile Configuration','AddUser','Member Category -SA'],$role->role_id))
<li class="nav-item has-treeview">
            <a href="#" class="nav-link" style="color:#3e3e3e">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configurations
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style=" padding-left:20px">
              @if($role->havePermission('About Us',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','About Us')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('aboutus') }}" class="nav-link {{ (request()->segment(2) == 'aboutus') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-info-circle  fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li> 
              @endif
              @if($role->havePermission('Compliance',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','Compliance')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.compliance') }}" class="nav-link {{ (request()->segment(2) == 'list.compliance') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-ellipsis-v  fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li>
              @endif


              @if($role->havePermission('Language Permission',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','Language Permission')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.languageLock') }}" class="nav-link {{ (request()->segment(2) == 'list.languageLock') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-language fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li> 
              @endif
              @if($role->havePermission('App Image',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','App Image')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.AppList') }}" class="nav-link {{ (request()->segment(2) == 'list.AppList') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-file-image-o fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li>
              @endif
              @if($role->havePermission('App Icon',$role->role_id))   
              <?php

                          $permission = App\Models\Permission::where('slug','App Icon')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.appIcon') }}" class="nav-link {{ (request()->segment(2) == 'list.appIcon') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-wrench fa-lg"></i>
                    <p>  {{$permission->name}}</p>
                </a>
              </li>
              @endif
              @if($role->havePermission('Profile Configuration',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','Profile Configuration')->first();
                      ?> 
              <li class="nav-item">
                  <a href="{{ route('list.ProfileDetails') }}" class="nav-link {{ (request()->segment(2) == 'list.ProfileDetails') ? 'active' : '' }}" style="color:#3e3e3e">
                    <i class="nav-icon fa fa-user fa-lg"></i>
                    <p> {{$permission->name}}</p>
                </a>
              </li> 
              @endif    
              @if($role->havePermission('AddUser',$role->role_id))
              <?php

                          $permission = App\Models\Permission::where('slug','AddUser')->first();
                      ?>  
            <li class="nav-item">
                <a href="{{ route('list.admin') }}" class="nav-link {{ (request()->segment(2) == 'list.admin') ? 'active' : '' }}" style="color:#3e3e3e">
                  <i class="nav-icon fa fa-check fa-lg"></i>
                  <p>  {{$permission->name}}</p>
              </a>
            </li>
            @endif
            @if($role->havePermission('Member Category -SA',$role->role_id)) 
            <?php

                          $permission = App\Models\Permission::where('slug','Member Category -SA')->first();
                      ?> 
            <li class="nav-item">
                <a href="{{ route('MemberCategory.list') }}" class="nav-link {{ (request()->segment(2) == 'MemberCategory.list') ? 'active' : '' }}" style="color:#3e3e3e">
                  <i class="nav-icon fa fa-list-alt fa-lg"></i>
                  <p> {{$permission->name}}</p>
              </a>
            </li>
          @endif     
          
             
            </ul>
          </li>
@endif











<br><br><br>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
