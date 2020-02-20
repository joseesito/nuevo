@csrf
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Ruc:</label>
            <input type="text" name="ruc" class="form-control" value="{{ old('ruc', $company->ruc) }}" placeholder="Ingrese el Nro de RUC">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" placeholder="Ingrese razón social">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="form-group">
            <label>Dirección:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $company->address) }}" placeholder="Ingrese Dirección">
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <label>telefono:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}" placeholder="Ingrese Nro. de telefono">
        </div>
    </div>
</div>

<div class="row">
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn_submit_register">{{ $btnText }}</button>
    </div>
</div>
