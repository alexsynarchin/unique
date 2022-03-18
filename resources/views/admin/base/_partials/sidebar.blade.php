<el-aside class="el-aside--sidebar">
<div class="sidebar-header">
    <img src="{{Url::asset('images/logo.svg')}}">
</div>
<sidebar-nav :current_url="'{{Request::path()}}'"></sidebar-nav>


</el-aside>
