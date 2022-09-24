<div class="form-row">
    @if ($task == "create")
    <div class="form-group col-md-6">
        <label for="department_id">Department :<span class="text-danger"><b>❋</b></span></label>
        <select id="department_id" class="form-control" wire:model="department_id" name="department_id">
            <option value="">Choose...</option>
            @foreach ($Department as $d)
            <option value="{{ $d->id }}">{{ $d->department_name }}</option>
            @endforeach
        </select>
        @if ($errors->has('department_id'))
        <span class="text-danger">{{ $errors->first('department_id') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="dept_section_id">Department Section :<span class="text-danger"><b>❋</b></span></label>
        <select id="dept_section_id" class="form-control" name="dept_section_id">
            <option value="" selected>Choose...</option>
            @foreach ($section as $d)
            <option value="{{ $d->id }}">{{ $d->section_name }}</option>
            @endforeach
        </select>
        @if ($errors->has('dept_section_id'))
        <span class="text-danger">{{ $errors->first('dept_section_id') }}</span>
        @endif
    </div>
    @endif



    @if ($task == "edit")
    <div class="form-group col-md-6">
        <label for="department_id2">Department :<span class="text-danger"><b>❋</b></span></label>
        <select id="department_id2" class="form-control" wire:click="changeEvent($event.target.value)" name="department_id">
            @foreach ($Department as $d)
            <option value="{{ $d->id }}" @if ($EmployeeDpId == $d->id)
                Selected
            @endif>{{ $d->department_name }}</option>
            @endforeach
        </select>
        @if ($errors->has('department_id'))
        <span class="text-danger">{{ $errors->first('department_id') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="dept_section_id2">Department Section :<span class="text-danger"><b>❋</b></span></label>
        <select id="dept_section_id2" class="form-control"  name="dept_section_id">

            <option value="" @if ($selected == false) selected @endif >Choose...</option>
            @foreach ($section as $d)

            <option value="{{ $d->id }}"  @if ($selected == true) @if ($dept_section_id == $d->id) selected @endif  @endif >{{ $d->section_name }}</option>

            @endforeach

        </select>
        @if ($errors->has('dept_section_id'))
        <span class="text-danger">{{ $errors->first('dept_section_id') }}</span>
        @endif
    </div>
    @endif


</div>
