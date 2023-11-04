@extends('dashboard')

@section('content')
<div class="vh-100">
 <div class="row">
   <h1 class="fs-1 text-dark text-center fw-bold my-3">Roles & Permissions</h1>
   <div class="row">
    <span>@include('layouts.partials.error')</span>
    <span>@include('layouts.partials.success')</span>
   </div>
   <form method="post" action="{{ route('update_roles') }}">
    @csrf
    <table  class="table table-striped">
     <thead class="table-dark">
      <tr>
       <th>Permissions</th>
       @foreach ($roles_with_permissions as $role => $permission)
       <th>{{$role}}</th>
       @endforeach
      </tr>
     </thead>
     <tbody>
      @foreach ($all_permissions as $permission)
       <tr>
           <th>{{ $permission }}</th>
           @foreach ($roles_with_permissions as $role => $rolePermissions)
               <th>
                   <input type="checkbox" name="permissions[{{ $role }}][{{ $permission}}]" @if($role == 'Admin') disabled @endif
                       @if (in_array($permission, $rolePermissions['permissions']->pluck('name')->toArray())) checked @endif>
               </th>
           @endforeach
       </tr>
      @endforeach
     </tbody>
    </table>
    <div class="col-4 d-grid mx-auto">
     <button type="submit" class="btn btn-dark btn-block my-3">
        Update Permissions
     </button>
    </div>
   </form>
 </div>
</div>
</section>

@endsection
