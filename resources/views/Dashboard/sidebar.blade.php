<div class="col-lg-3">
    <div class=" border border-0 rounded min-vh-100 mt-3 bg-gradient p-3 ">
        <div class="logo text-secondary">
            <h5>Pandora</h5>
        </div>
        <div class="lists mt-5">
            <div class="list-group">
               <a href="{{route("dashboard.create")}}" class="text-secondary rounded listItem list-group-item bg-primary border-0  list-group-item-action mb-4"> <i class="fas fa-plus-circle me-3"></i>Post Create</a>
               <a href="{{route("dashboard.index")}}" class="text-secondary rounded listItem list-group-item bg-primary border-0 list-group-item-action mb-4"><i class="fas fa-list me-3"></i>Post Lists</a>
               <a href="{{route("tag.create")}}" class="text-secondary rounded listItem list-group-item bg-primary border-0 list-group-item-action mb-4"><i class="fas fa-plus-circle me-3"></i>Tags Create</a>
                
               <a href="{{route("profile.edit")}}" class="text-secondary rounded listItem list-group-item bg-primary border-0 list-group-item-action mb-4"><i class="fas fa-user me-3"></i>Update Profile</a>
               <a href="{{route("profile.epassword")}}" class="text-secondary rounded listItem list-group-item bg-primary border-0 list-group-item-action mb-4"><i class="fas fa-user me-3"></i>Change Password</a>

                <a class="text-secondary rounded listItem list-group-item bg-primary border-0 list-group-item-action mb-4" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <i class="fas fa-user me-3"></i> {{ __('Logout') }}
                </a>
        

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            
             </div>
        </div>
        <div class="errorPanel">
            <ul class="errorUl text-danger">

            </ul>
        </div>
    </div>
</div>
 
