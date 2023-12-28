@extends('layouts.appDashboard')

@section('styles')

@endsection

@section('openModAccess')
    open
@endsection

@section('activeListPermission')
    active
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('dashboard') }}">Inicio</a>
            </li>
            <li class="active">Mantenedor de Permisos</li>
        </ul><!-- /.breadcrumb -->

        <div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
            </form>
        </div><!-- /.nav-search -->
    </div>
@endsection

@section('content')
    <a id="newPermission" class="btn btn-success">
        <i class="icon-2x fa fa-plus"></i> Nuevo Permiso
    </a>
    <hr>
    <table class="table" id="dynamic-table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Slug</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $permissions as $permission )
        <tr>
            <th scope="row">{{ $permission->id }}</th>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
            <td>

                <a data-edit="{{ $permission->id }}" data-description="{{ $permission->description }}" data-name="{{ $permission->name }}"  class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                <a data-delete="{{ $permission->id }}" data-description="{{ $permission->description }}" data-name="{{ $permission->name }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div id="modalCreate" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nuevo permiso</h4>
                </div>
                <form id="formCreate" class="form-horizontal" data-url="{{ route('permission.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name"> Permiso </label>

                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="col-xs-10 col-sm-10" placeholder="Ejm: product_list" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="description"> Descripción </label>

                            <div class="col-sm-9">
                                <input type="text" id="description" name="description" class="col-xs-10 col-sm-10" placeholder="Ejm: Listar productos" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalEdit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modificar permiso</h4>
                </div>
                <form id="formEdit" class="form-horizontal" data-url="{{ route('permission.update') }}" >
                    @csrf
                    <input type="hidden" name="permission_id" id="permission_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="nameE"> Permiso </label>

                            <div class="col-sm-9">
                                <input type="text" id="nameE" name="name" class="col-xs-10 col-sm-10" placeholder="Ejm: product_list" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="descriptionE"> Descripción </label>

                            <div class="col-sm-9">
                                <input type="text" id="descriptionE" name="description" class="col-xs-10 col-sm-10" placeholder="Ejm: Listar productos" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="modalDelete" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmar eliminación</h4>
                </div>
                <form id="formDelete" data-url="{{ route('permission.destroy') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="permission_id" name="permission_id">
                        <p id="nameDelete"></p>
                        <p id="descriptionDelete"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/access/permission.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('intranet/assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('intranet/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('intranet/assets/js/dataTables.select.min.js') }}"></script>  

    <script>
        new DataTable('#dynamic-table');
    </script>
@endsection