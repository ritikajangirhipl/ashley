@php
    $counter = 1;
    $serviceAdditionalFields = null;

    if(isset($service)){        
        $serviceAdditionalFields = $service->additionalFields;
        if($serviceAdditionalFields->count() > 0){
            $counter = $serviceAdditionalFields->count();
        }
    }
@endphp

<div class="col-12 col-md-12" id="service-fields-block">
    <div class="mt-3 mb-4 border-bottom">
        <h5 class="d-flex align-items-center justify-content-between">{{ trans('cruds.services.fields.add_new') }} 
            <a href="javascript:void(0);" onclick="addServiceFields($(this))" id="addAdditionalField add-more-field" class="btn btn-sm btn-success add_additional_field" data-counter="{{ $counter }}" title="Add More">
                <i class="fa fa-plus"></i>
            </a>
        </h5>
    </div>
    <div class="service-fields-details">
        @if($serviceAdditionalFields && $serviceAdditionalFields->count() > 0)
            
            {{ Form::hidden('deleted_fields', null,['id' => 'delete-additional-fields']) }}

            @foreach($serviceAdditionalFields as $key => $serviceField)
                @php
                    $number = $key+1;
                @endphp
                <div class="service-fields-outer">
                    <div class="row position-relative repeatable-content-service-fields service-field-{{ $number }} " data-row="{{ $number }}" >
                        <input type="hidden" class="service_additional_field_id" name="additional_fields[{{ $number }}][additional_field_id]" value="{{ $serviceField->id }}">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>{{ trans('cruds.services.fields.field_name') }}</label>
                                <input type="text" id="services_field_name_{{ $number }}" name="additional_fields[{{ $number }}][field_name]" value="{{ $serviceField->field_name ?? '' }}" placeholder="{{ trans('cruds.services.fields.field_name') }}" class="form-control services_field_name" >
                            </div> 
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-12 services_field_type_wrap">
                            <div class="form-group">
                                <label >{{ trans('cruds.services.fields.field_type') }}</label>
                                <select name="additional_fields[{{ $number }}][field_type]" id="services_field_type_{{ $number }}" class="form-control services_field_type">
                                    <!-- <option value="">{{ 'Select ' . trans('cruds.services.fields.field_type') }}</option> -->
                                    @foreach($fieldTypes as $id => $name)
                                        <option value="{{ $id }}" {{ $serviceField->field_type == $id ? 'selected' : ''}}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        @php
                            $displayCombo = "none";
                            $options = [];
                            $tempOptions = [];

                            if ($serviceField->field_type == 2) {
                                $displayCombo = "block";
                                
                                if($serviceField->combo_values){
                                    $tempOptions = json_decode($serviceField->combo_values);
                                    $options = array_values($tempOptions);
                                    $options = array_combine($tempOptions,$options);
                                }
                            }
                        @endphp

                        <!-- <div class="col-lg-3 col-md-3 col-sm-12 combo_values_wrap" id="combo_values_wrap_{{ $number }}" style="display:{{ $displayCombo }};">
                            <div class="form-group">
                                <label for="combo_values">{{ trans('cruds.services.fields.combo_values') }}</label>
                                <select class="form-control services_combo_values" name="additional_fields[{{ $number }}][combo_values][]" multiple="multiple" id="services_combo_values_{{ $number }}">
                                    @foreach($tempOptions as $option)
                                        <option value="{{ $option }}" selected>{{ $option }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div> -->

                        <div class="col-lg-3 col-md-3 col-sm-12 combo_values_wrap" id="combo_values_wrap_{{ $number }}" style="display:{{ $displayCombo }};">
                            <div class="form-group">
                                <label for="combo_values">{{ trans('cruds.services.fields.combo_values') }}<span class="text-danger">*</span></label>
                                {{ Form::select('additional_fields['.$number.'][combo_values][]', $options, $options,['class' => "form-control services_combo_values multi-select", 'id' => 'services_combo_values_'.$number, 'required' => false, 'multiple' => "multiple"]) }}

                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-lg-3 col-md-3 col-sm-12 combo_values_wrap" id="combo_values_wrap_{{ $number }}" style="display:{{ $displayCombo }};">
                            <div class="form-group">
                                <label for="combo_values">{{ trans('cruds.services.fields.combo_values') }}</label>

                                @if($serviceField->field_type == 2)
                                        @foreach($serviceAdditionalFields as $key => $item)
                                            @php
                                                $isSelected = false;
                                                if($item->id && $item->combo_values) {
                                                    $isSelected = true;
                                                } 
                                            @endphp
                                            @php
                                                $comboValuesString = isset($item->combo_values) && !empty($item->combo_values) ? implode(', ', json_decode($item->combo_values, true)) : $value;
                                            @endphp
                                            <input type="text" class="form-control" value="{{ $comboValuesString }}" readonly>
                                        @endforeach
                                @else
                                    <select class="form-control services_combo_values" name="additional_fields[0][combo_values][]" multiple="multiple" id="services_combo_values_0">
                                    </select>
                                @endif
                            </div>
                        </div> --}} 

                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <label >{{ trans('cruds.services.fields.field_required') }}</label>

                                <select name="additional_fields[{{ $number }}][field_required]" id="services_field_required_{{ $number }}" class="form-control services_field_required" >
                                    {{-- <option value="">{{ 'Select ' . trans('cruds.services.fields.field_required') }}</option> --}}
                                    @foreach($inputDetailsOpts as $id => $name)
                                        <option value="{{ $id }}" {{ $serviceField->field_required == $id ? 'selected' : ''}}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   

                        <div class="col-2 col-sm-6 col-md-2 col-lg-2 align-self-end service-field-actions">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="del-field-btn del_field btn btn-sm btn-danger mb-0" title="Remove" data-services="service-field-{{ $number }}" >
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @else
        <div class="service-fields-outer">
            <div class="row position-relative repeatable-content-service-fields service-field-0" data-row="0" >
            
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label >{{ trans('cruds.services.fields.field_name') }}</label>
                        <input type="text" placeholder="{{ trans('cruds.services.fields.field_name') }}" id="services_field_name_0" name="additional_fields[0][field_name]" class="form-control services_field_name">
                        @if($errors->has('additional_fields.0.field_name'))
                            <span class="text-danger">{{ $errors->first('additional_fields.0.field_name') }}</span>
                        @endif
                    </div> 
                </div>
                
                <div class="col-lg-2 col-md-2 col-sm-12 services_field_type_wrap">
                    <div class="form-group">
                        <label>{{ trans('cruds.services.fields.field_type') }}</label>
                        <select name="additional_fields[0][field_type]" id="services_field_type_0" class="form-control services_field_type">
                            <!-- <option value="">{{ 'Select ' . trans('cruds.services.fields.field_type') }}</option> -->
                            @foreach($fieldTypes as $id => $name)
                                <option value="{{ $id }}">
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-12 combo_values_wrap" id="combo_values_wrap_0" style="display:none;">
                    <div class="form-group">
                        <label for="combo_values">{{ trans('cruds.services.fields.combo_values') }}</label>
                        <select class="form-control services_combo_values" name="additional_fields[0][combo_values][]" multiple="multiple" id="services_combo_values_0">

                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>{{ trans('cruds.services.fields.field_required') }}</label>

                        <select name="additional_fields[0][field_required]" id="services_field_required_0" class="form-control services_field_required">
                            {{-- <option value="">{{ 'Select ' . trans('cruds.services.fields.field_required') }}</option> --}}
                            @foreach($inputDetailsOpts as $id => $name)
                                <option value="{{ $id }}" >
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>   


                <div class="col-2 col-sm-6 col-md-2 col-lg-2 align-self-end service-field-actions">
                    <div class="form-group">
                        <a href="javascript:void(0);" class="mb-0 del-field-btn del_field btn btn-sm btn-danger" title="Remove" data-services="service-field-0" >
                            <i class="fa fa-minus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif   
    </div> 
</div>

            
