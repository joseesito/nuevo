@csrf
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" placeholder="Ingrese nombre">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Tipo de Curso:</label>
            <select name="type_course_id" class="form-control">
                @foreach($type_courses as $type_course)
                    <option value="{{ $type_course->id }}"
                    @if ($type_course->id == old('type_course_id', $course->type_course_id))
                        selected="selected"
                    @endif
                    >{{ $type_course->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Horas:</label>
            <input type="number" name="hours" class="form-control" value="{{ old('hours', $course->hours) }}" placeholder="Ingrese Dirección">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Nota Minima:</label>
            <input type="number" name="grade_min" class="form-control" value="{{ old('grade_min', $course->grade_min) }}" placeholder="Ingrese Nota Minima">
        </div>
    </div>
</div>

<div class="row">
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ $btnText }}</button>
    </div>
</div>
