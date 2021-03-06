<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
            <div class="logo">
                <a href="/home" class="simple-text">
                    HQMS
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <!--<li>
                        <a href="dashboard.html">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/manage-department">
                            <i class="material-icons">person</i>
                            <p>Manage Department</p>
                        </a>
                    </li>
                    <li>
                        <a href="/manage-doctors">
                            <i class="material-icons">content_paste</i>
                            <p>Manage Doctors</p>
                        </a>
                    </li>-->
                    <li class="@if(Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\ManagePatientController@index') active @endif">
                        <a href="/manage-patient">
                            <i class="material-icons">library_books</i>
                            <p>Manage Patient</p>
                        </a>
                    </li>
                    <li class="@if(Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\ManagePatientController@add') active @endif">
                        <a href="/manage-patient/add">
                            <i class="material-icons">unarchive</i>
                            <p>Register Patient</p>
                        </a>
                    </li>
					<li class="@if(Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\ManageHallController@index' || Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\ManageHallController@add') active @endif">
                        <a href="/manage-hall/">
                            <i class="material-icons">unarchive</i>
                            <p>Manage Halls</p>
                        </a>
                    </li>
					<li class="@if(Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\TokenStatusController@index') active @endif">
                        <a href="/token-status/">
                            <i class="material-icons">unarchive</i>
                            <p>Token Status</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>